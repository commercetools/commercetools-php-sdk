<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Helper\Annotate;

use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Common\Collection;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Price;
use Commercetools\Core\Model\CustomObject\CustomObject;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Request\Orders\OrderByOrderNumberGetRequest;
use Commercetools\Core\Request\PsrRequest;

class AnnotationGenerator
{
    /**
     * @var \ReflectionClass
     */
    protected $reflectionClass;
    protected $newDocBlock;
    protected $fields;
    protected $fieldNames;
    protected $includes;
    protected $uses;

    public function run($path)
    {
        $allFiles = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
        $phpFiles = new \RegexIterator($allFiles, '/\.php$/');

        $this->analyzeFiles($phpFiles);
    }

    protected function analyzeFiles(\RegexIterator $phpFiles)
    {
        $jsonObjects = $this->getJsonObjects($phpFiles);

        foreach ($jsonObjects as $jsonObject) {
            $annotator = new ClassAnnotator($jsonObject);

            $annotator->generate();
        }

        $collections = $this->getCollectionObjects($phpFiles);

        foreach ($collections as $collection) {
            $annotator = new ClassAnnotator($collection);

            $annotator->generateCurrentMethod();
        }

        $requests = $this->getRequestObjects($phpFiles);

        foreach ($requests as $request) {
            $annotator = new ClassAnnotator($request);

            $annotator->generateMapResponseMethod();
        }

        $domainRequests = $this->getRequestDomainObjects($phpFiles);
        foreach ($domainRequests as $domain => $requests) {
            if ($domain == 'Me') {
                continue;
            }
            $this->generateDomainRequestBuilder($domain, $requests);
        }
        $this->generateRequestBuilder(array_keys($domainRequests));

        $domainUpdates = $this->getUpdateObjects($phpFiles);

        foreach ($domainUpdates as $domain => $updates) {
            $this->generateActionBuilder($domain, $updates);
        }
        $this->generateUpdateBuilder(array_keys($domainUpdates));
    }

    protected function getJsonObjects(\RegexIterator $phpFiles)
    {
        $jsonObjects = [];
        foreach ($phpFiles as $phpFile) {
            $class = $this->getClassName($phpFile->getRealPath());
            if (strpos($class, 'Core\\Helper') > 0) {
                continue;
            }

            if (!empty($class)) {
                $class = new \ReflectionClass($class);
                if ($class->isSubclassOf(JsonObject::class)) {
                    $jsonObjects[] = $class->getName();
                }
            }
        }

        return $jsonObjects;
    }

    protected function getCollectionObjects(\RegexIterator $phpFiles)
    {
        $collectionObjects = [];
        foreach ($phpFiles as $phpFile) {
            $class = $this->getClassName($phpFile->getRealPath());
            if (strpos($class, 'Core\\Helper') > 0) {
                continue;
            }

            if (!empty($class)) {
                $class = new \ReflectionClass($class);
                if ($class->isSubclassOf(Collection::class)) {
                    $collectionObjects[] = $class->getName();
                }
            }
        }

        return $collectionObjects;
    }

    protected function getRequestObjects(\RegexIterator $phpFiles)
    {
        $requestObjects = [];
        foreach ($phpFiles as $phpFile) {
            $class = $this->getClassName($phpFile->getRealPath());
            if (strpos($class, 'Core\\Helper') > 0) {
                continue;
            }

            if (!empty($class)) {
                $class = new \ReflectionClass($class);
                if ($class->isSubclassOf(AbstractApiRequest::class)) {
                    $requestObjects[] = $class->getName();
                }
            }
        }

        return $requestObjects;
    }

    protected function getRequestDomainObjects(\RegexIterator $phpFiles)
    {
        $requestObjects = [];
        foreach ($phpFiles as $phpFile) {
            $class = $this->getClassName($phpFile->getRealPath());
            if (strpos($class, 'Core\\Helper') > 0) {
                continue;
            }

            if (!empty($class)) {
                $class = new \ReflectionClass($class);
                if ($class->isSubclassOf(AbstractApiRequest::class)
                    && $class->isInstantiable()
                    && $class->name !== PsrRequest::class
                ) {
                    $namespaceParts = explode("\\", $class->getNamespaceName());
                    $domain = $namespaceParts[count($namespaceParts) - 1];
                    if (strpos($class, 'ProductProjection') > 0) {
                        $domain = 'ProductProjections';
                    }
                    $requestObjects[$domain][] = $class->getName();
                }
            }
        }
        ksort($requestObjects);
        return $requestObjects;
    }

    protected function getUpdateObjects(\RegexIterator $phpFiles)
    {
        $actions = [];
        foreach ($phpFiles as $phpFile) {
            $class = $this->getClassName($phpFile->getRealPath());
            if (strpos($class, 'Core\\Helper') > 0) {
                continue;
            }

            if (!empty($class)) {
                $class = new \ReflectionClass($class);
                if ($class->isSubclassOf(AbstractAction::class) && $class->isInstantiable()) {
                    $namespaceParts = explode("\\", $class->getNamespaceName());
                    $domain = $namespaceParts[count($namespaceParts) - 2];
                    $actions[$domain][] = $class->getName();
                }
            }
        }
        ksort($actions);
        return $actions;
    }

    protected function getClassName($fileName)
    {
        $tokens = $this->tokenize($fileName);
        $namespace = '';
        for ($index = 0; isset($tokens[$index]); $index++) {
            if (!isset($tokens[$index][0])) {
                continue;
            }
            if (T_NAMESPACE === $tokens[$index][0]) {
                $index += 2; // Skip namespace keyword and whitespace
                while (isset($tokens[$index]) && is_array($tokens[$index])) {
                    $namespace .= $tokens[$index++][1];
                }
            }
            if (T_CLASS === $tokens[$index][0]) {
                $index += 2; // Skip class keyword and whitespace
                $class = $namespace.'\\'.$tokens[$index][1];
                return $class;
            }
        }

        return null;
    }

    protected function tokenize($fileName)
    {
        $content = file_get_contents($fileName);
        return token_get_all($content);
    }

    public function generateActionBuilder($domain, $updates)
    {
        $className = ucfirst($domain) . 'ActionBuilder';
        $fileName = __DIR__ . '/../../Builder/Update/' . $className . '.php';

        $updateMethods = [];
        $uses = [];

        sort($updates);
        foreach ($updates as $update) {
            $uses[] = 'use ' . $update . ';';
            $updateClass = new \ReflectionClass($update);

            $docComment = $updateClass->getDocComment();
            $docLinks = [];
            if (strpos($docComment, '@link https://docs.') > 0) {
                $docComment = explode(PHP_EOL, $docComment);
                $docLinks = array_map(
                    function ($link) {
                        return trim(str_replace(['*', '@link'], '', $link));
                    },
                    array_filter($docComment, function ($line) {
                        return strpos($line, '@link') > 0;
                    })
                );
            }
            $docLinks = count($docLinks) > 0 ?
                ' @link ' . implode(PHP_EOL . '     * @link ', $docLinks):
                '';

            $actionShortName = $updateClass->getShortName();
            $action = new $update();
            $actionName = $action->getAction();

            $method = <<<METHOD
    /**
     *$docLinks
     * @param $actionShortName|callable \$action
     * @return \$this
     */
    public function $actionName(\$action = null)
    {
        \$this->addAction(\$this->resolveAction($actionShortName::class, \$action));
        return \$this;
    }
METHOD;
            $updateMethods[] = $method;
        }

        $methods = implode(PHP_EOL . PHP_EOL, $updateMethods);
        $uses = implode(PHP_EOL, $uses);
        $content = <<<EOF
<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
$uses

class $className
{
    private \$actions = [];

$methods

    /**
     * @return $className
     */
    public function of()
    {
        return new self();
    }

    /**
     * @param \$class
     * @param \$action
     * @return AbstractAction
     * @throws InvalidArgumentException
     */
    private function resolveAction(\$class, \$action = null)
    {
        if (is_null(\$action) || is_callable(\$action)) {
            \$callback = \$action;
            \$emptyAction = \$class::of();
            \$action = \$this->callback(\$emptyAction, \$callback);
        }
        if (\$action instanceof \$class) {
            return \$action;
        }
        throw new InvalidArgumentException(
            sprintf('Expected method to be called with or callable to return %s', \$class)
        );
    }

    /**
     * @param \$action
     * @param callable \$callback
     * @return AbstractAction
     */
    private function callback(\$action, callable \$callback = null)
    {
        if (!is_null(\$callback)) {
            \$action = \$callback(\$action);
        }
        return \$action;
    }

    /**
     * @param AbstractAction \$action
     * @return \$this;
     */
    public function addAction(AbstractAction \$action)
    {
        \$this->actions[] = \$action;
        return \$this;
    }

    /**
     * @return array
     */
    public function getActions()
    {
        return \$this->actions;
    }

    /**
     * @param array \$actions
     * @return \$this
     */
    public function setActions(array \$actions)
    {
        \$this->actions = \$actions;
        return \$this;
    }
}

EOF;
        file_put_contents($fileName, $content);
    }

    public function generateUpdateBuilder(array $domains)
    {
        $builderName = 'ActionBuilder';
        $fileName = __DIR__ . '/../../Builder/Update/' . $builderName . '.php';

        $methods = [];
        foreach ($domains as $domain) {
            $className = ucfirst($domain) . 'ActionBuilder';
//            $uses[] = 'use Commercetools\Core\Builder\Update\\' . $className . ';';
            $methodName = lcfirst($domain);
            $method = <<<METHOD
    /**
     * @return $className
     */
    public function $methodName()
    {
        return new $className();
    }
METHOD;
            $methods[] = $method;
        }

//        $uses = implode(PHP_EOL, $uses);
        $methods = implode(PHP_EOL . PHP_EOL, $methods);
        $content = <<<EOF
<?php

namespace Commercetools\Core\Builder\Update;

class $builderName
{
$methods

    /**
     * @return $builderName
     */
    public static function of()
    {
        return new self();
    }
}

EOF;
        file_put_contents($fileName, $content);
    }

    private function singularize($word)
    {
        $singular = array(
            '/(quiz)zes$/i' => '\\1',
            '/(matr)ices$/i' => '\\1ix',
            '/(vert|ind)ices$/i' => '\\1ex',
            '/^(ox)en/i' => '\\1',
            '/(alias|status)es$/i' => '\\1',
            '/([octop|vir])i$/i' => '\\1us',
            '/(cris|ax|test)es$/i' => '\\1is',
            '/(shoe)s$/i' => '\\1',
            '/(o)es$/i' => '\\1',
            '/(bus)es$/i' => '\\1',
            '/([m|l])ice$/i' => '\\1ouse',
            '/(x|ch|ss|sh)es$/i' => '\\1',
            '/(m)ovies$/i' => '\\1ovie',
            '/(s)eries$/i' => '\\1eries',
            '/([^aeiouy]|qu)ies$/i' => '\\1y',
            '/([lr])ves$/i' => '\\1f',
            '/(tive)s$/i' => '\\1',
            '/(hive)s$/i' => '\\1',
            '/([^f])ves$/i' => '\\1fe',
            '/(^analy)ses$/i' => '\\1sis',
            '/((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i' => '\\1\\2sis',
            '/([ti])a$/i' => '\\1um',
            '/(n)ews$/i' => '\\1ews',
            '/s$/i' => ''
        );

        foreach ($singular as $rule => $replacement) {
            if (preg_match($rule, $word)) {
                return preg_replace($rule, $replacement, $word);
            }
        }
        return $word;
    }

    public function generateRequestBuilder(array $domains)
    {
        sort($domains);
        $builderName = 'RequestBuilder';
        $fileName = __DIR__ . '/../../Builder/Request/' . $builderName . '.php';

        $methods = [];
        foreach ($domains as $domain) {
            $className = ucfirst($this->singularize($domain)) . 'RequestBuilder';
//            $uses[] = 'use Commercetools\Core\Builder\Update\\' . $className . ';';
            $methodName = lcfirst($domain);
            $method = <<<METHOD
    /**
     * @return $className
     */
    public function $methodName()
    {
        return new $className();
    }
METHOD;
            $methods[] = $method;
        }

//        $uses = implode(PHP_EOL, $uses);
        $methods = implode(PHP_EOL . PHP_EOL, $methods);
        $content = <<<EOF
<?php

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\PsrRequest;
use Psr\Http\Message\RequestInterface;

class $builderName
{
$methods

    /**
     * @param RequestInterface \$request
     * @return PsrRequest
     */
    public function request(RequestInterface \$request)
    {
        return PsrRequest::ofRequest(\$request);
    }

    /**
     * @return $builderName
     */
    public static function of()
    {
        return new self();
    }
}

EOF;
        file_put_contents($fileName, $content);
    }

    public function generateDomainRequestBuilder($domain, $requests)
    {
        $singularDomain = $this->singularize($domain);
        $className = ucfirst($singularDomain) . 'RequestBuilder';
        $fileName = __DIR__ . '/../../Builder/Request/' . $className . '.php';

        $requestMethods = [];
        $uses = [];

        sort($requests);
        foreach ($requests as $request) {
            $uses[] = 'use ' . $request . ';';
            $requestClass = new \ReflectionClass($request);

            $docComment = $requestClass->getDocComment();
            $docLinks = [];
            if (strpos($docComment, '@link https://docs.') > 0) {
                $docComment = explode(PHP_EOL, $docComment);
                $docLinks = array_map(
                    function ($link) {
                        return trim(str_replace(['*', '@link'], '', $link));
                    },
                    array_filter($docComment, function ($line) {
                        return strpos($line, '@link') > 0;
                    })
                );
            }
            $docLinks = count($docLinks) > 0 ?
                ' @link ' . implode(PHP_EOL . '     * @link ', $docLinks):
                '';

            $requestShortName = $requestClass->getShortName();

            $methodName = lcfirst(preg_replace(['/^' . $singularDomain . '/', '/Request$/'], '', $requestShortName));
            $resultClassName = 'Commercetools\Core\Model\\' . $singularDomain . '\\' .
                ($singularDomain !== 'Inventory' ? $singularDomain : 'InventoryEntry');
            if (class_exists($resultClassName)) {
                $resultClass = new \ReflectionClass($resultClassName);
            } else {
                var_dump($resultClassName);
            }
            switch ($methodName) {
                case 'create':
                    $factoryMethod = $requestClass->getMethod('ofDraft');
                    $params = $factoryMethod->getParameters();
                    $draftParam = current($params);
                    $type = $draftParam->getClass();
                    $uses[] = 'use ' . $type->getName() . ';';
                    $methodParams = $type->getShortName() . ' $' . $draftParam->getName();
                    $factoryCall = 'ofDraft($' . $draftParam->getName() . ')';
                    break;
                case 'createFromCart':
                    $uses[] = 'use ' . Cart::class . ';';
                    $methodParams = 'Cart $cart';
                    $factoryCall = 'ofCartIdAndVersion($cart->getId(), $cart->getVersion())';
                    break;
                case 'emailConfirm':
                    $methodParams = '$token';
                    $factoryCall = 'ofToken($token)';
                    break;
                case 'emailToken':
                    $methodName = 'createEmailVerificationToken';
                    $methodParams = 'Customer $customer, $ttlMinutes';
                    $factoryCall = 'ofIdVersionAndTtl($customer->getId(), $customer->getVersion(), $ttlMinutes)';
                    break;
                case 'byTokenGet':
                    $methodName = 'getByPasswordToken';
                    $methodParams = '$tokenValue';
                    $factoryCall = 'ofToken($tokenValue)';
                    break;
                case 'login':
                    $methodParams = '$email, $password, $updateProductData = false, $anonymousCartId = null';
                    $factoryCall = 'ofEmailPasswordAndUpdateProductData(
            $email,
            $password,
            $updateProductData,
            $anonymousCartId
        )';
                    break;
                case 'passwordChange':
                    $methodName = 'changePassword';
                    $methodParams = 'Customer $customer, $currentPassword, $newPassword';
                    $factoryCall = 'ofIdVersionAndPasswords(
            $customer->getId(),
            $customer->getVersion(),
            $currentPassword,
            $newPassword
        )';
                    break;
                case 'matching':
                    $uses[] = 'use ' . Price::class . ';';
                    $methodParams = '$productId, $variantId, Price $price';
                    $factoryCall = 'ofProductIdVariantIdAndPrice($productId, $variantId, $price)';
                    break;
                case 'replicate':
                    $methodParams = '$cartId';
                    $factoryCall = 'ofCartId($cartId)';
                    break;
                case 'passwordReset':
                    $methodName = 'resetPassword';
                    $methodParams = '$tokenValue, $newPassword';
                    $factoryCall = 'ofTokenAndPassword($tokenValue, $newPassword)';
                    break;
                case 'passwordToken':
                    $methodName = 'createResetPasswordToken';
                    $methodParams = '$email';
                    $factoryCall = 'ofEmail($email)';
                    break;
                case 'emailConfirm':
                    $methodName = 'confirmEmail';
                    $methodParams = '$tokenValue';
                    $factoryCall = 'ofToken($tokenValue)';
                    break;
                case 'update':
                case 'delete':
                    $uses[$resultClassName] = 'use ' . $resultClassName . ';';
                    $methodParams = $resultClass->getShortName() . ' $' . lcfirst($singularDomain);
                    $factoryCall = 'ofIdAndVersion($' . lcfirst($singularDomain) . '->getId(), $' . lcfirst($singularDomain) . '->getVersion())';
                    if ($domain == 'Project') {
                        $factoryCall = 'ofVersion($' . lcfirst($singularDomain) . '->getVersion())';
                    }
                    break;
                case 'updateByKey':
                case 'deleteByKey':
                case 'updateByOrderNumber':
                case 'deleteByOrderNumber':
                    $param = 'key';
                    if (strpos($methodName, 'ByOrderNumber') > 0) {
                        $param = 'orderNumber';
                    }
                    $uses[$resultClassName] = 'use ' . $resultClassName . ';';
                    $methodParams = $resultClass->getShortName() . ' $' . lcfirst($singularDomain);
                    $factoryCall = 'of' . ucfirst($param) . 'AndVersion($' . lcfirst($singularDomain) . '->get' . ucfirst($param) . '(), $' . lcfirst($singularDomain) . '->getVersion())';
                    if ($resultClass == CustomObject::class) {
                        $factoryCall = str_replace('ofKeyAndVersion', 'ofContainerAndKey', $factoryCall);
                    }
                    break;
                case preg_match('/^by([a-zA-Z]+)Get$/', $methodName, $matches) === 1:
                    $param = lcfirst($matches[1]);
                    if ($param == 'key' && $resultClassName == CustomObject::class) {
                        $methodName = 'getByContainerAndKey';
                        $methodParams = '$container, $key';
                        $factoryCall = 'ofContainerAndKey($container, $key)';
                        break;
                    }
                    if ($param == 'slug') {
                        $methodName = 'getBySlug';
                        $methodParams = '$slug, array $languages, $staged = false';
                        $factoryCall = 'ofSlugAndLanguages($slug, $languages)->staged($staged)';
                        break;
                    }
                    $methodName = 'getBy' . ucfirst($param);
                    if ($param == 'emailToken') {
                        $param = 'token';
                    }
                    $methodParams = '$' . $param;
                    $factoryCall = 'of' . ucfirst($param) . '($' . $param . ')';
                    break;
                default:
                    $methodParams = '';
                    $factoryCall = 'of()';
            }

            $factoryMethod = <<<METHOD
    /**
     *$docLinks
     * @return $requestShortName
     */
    public function $methodName($methodParams)
    {
        return $requestShortName::$factoryCall;
    }
METHOD;
            $requestMethods[] = $factoryMethod;
        }

        $factoryMethods = implode(PHP_EOL . PHP_EOL, $requestMethods);
        $uses = implode(PHP_EOL, $uses);
        $content = <<<EOF
<?php

namespace Commercetools\Core\Builder\Request;

$uses

class $className
{

$factoryMethods

    /**
     * @return $className
     */
    public function of()
    {
        return new self();
    }
}

EOF;
        file_put_contents($fileName, $content);
    }
}
