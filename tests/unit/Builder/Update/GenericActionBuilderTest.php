<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;


use Commercetools\Core\Builder\Update\ActionBuilder;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\AbstractApiRequest;
use PHPUnit\Framework\TestCase;

class GenericActionBuilderTest extends TestCase
{
    /**
     * @dataProvider getActionClasses
     * @param $className
     */
    public function testActionBuilder($domain, $className)
    {
        $action = new $className();
        $actionName = $action->getAction();
        $builder = ActionBuilder::of();
        $this->assertInstanceOf($className, current($builder->$domain()->$actionName()->getActions()));
    }

    public function getActionClasses()
    {
        $apiRequest = new \ReflectionClass(AbstractApiRequest::class);
        $allFiles = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(dirname($apiRequest->getFileName())));
        $phpFiles = new \RegexIterator($allFiles, '/\.php$/');

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
                    $actions[$class->getName()] = [$domain, $class->getName()];
                }
            }
        }

        return $actions;
    }

    private function getClassName($fileName)
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

    private function tokenize($fileName)
    {
        $content = file_get_contents($fileName);
        return token_get_all($content);
    }
}
