<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Helper\Annotate;

use Commercetools\Core\Model\Common\Collection;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\AbstractApiRequest;

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
            $csIgnore = strlen($actionShortName) > 55 ? '// @codingStandardsIgnoreLine' . PHP_EOL . '        ' : '';
            $method = <<<METHOD
    /**
     *$docLinks
     * @param $actionShortName|callable \$action
     * @return \$this
     */
    public function $actionName(\$action = null)
    {
        $csIgnore\$this->addAction(\$this->resolveAction($actionShortName::class, \$action));
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
        sort($domains);
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
}
