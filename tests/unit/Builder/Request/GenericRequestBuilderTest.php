<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;


use Commercetools\Core\Request\AbstractApiRequest;
use PHPUnit\Framework\TestCase;

class GenericRequestBuilderTest extends TestCase
{
    private static $requestClasses;

    /**
     * tests if all request classes are covered by the request builder dsl
     * @dataProvider getRequestClasses
     * @param $className
     */
    public function testBuilderRequest($className) {
        $builderClasses = $this->collectBuilderRequestObjects();

        $this->assertArrayHasKey($className, $builderClasses);
    }

    public function getRequestClasses()
    {
        $apiRequest = new \ReflectionClass(AbstractApiRequest::class);
        $allFiles = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(dirname($apiRequest->getFileName())));
        $phpFiles = new \RegexIterator($allFiles, '/\.php$/');

        $classes = [];
        foreach ($phpFiles as $phpFile) {
            $className = $this->getClassName($phpFile->getRealPath());
            if (is_null($className)) {
                continue;
            }
            $class = new \ReflectionClass($className);
            if ($class->isSubclassOf(AbstractApiRequest::class) && $class->isInstantiable()) {
                $classes[$class->getShortName()] = [$class->getName()];
            }
        }
        return $classes;
    }

    private function collectBuilderRequestObjects()
    {
        if (is_null(self::$requestClasses)) {
            $builder = new \ReflectionClass(RequestBuilder::class);

            $allFiles = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(dirname($builder->getFileName())));
            $phpFiles = new \RegexIterator($allFiles, '/\.php$/');

            $uses = [];
            foreach ($phpFiles as $phpFile) {
                $uses = $this->addUseStatements($phpFile->getRealPath(), $uses);
            }
            foreach ($uses as $use) {
                $class = new \ReflectionClass($use);
                if ($class->isSubclassOf(AbstractApiRequest::class)) {
                    self::$requestClasses[$class->getName()] = $class->getName();
                }
            }
        }

        return self::$requestClasses;
    }

    public function collect()
    {

    }

    private function addUseStatements($fileName, array $uses = [])
    {
        $tokens = $this->tokenize($fileName);
        for ($index = 0; isset($tokens[$index]); $index++) {
            if (!isset($tokens[$index][0])) {
                continue;
            }
            if (T_USE == $tokens[$index][0]) {
                $use = '';
                $index += 2;
                while ($tokens[$index][0] != T_AS && isset($tokens[$index]) && is_array($tokens[$index])) {
                    if ($tokens[$index][0] == T_WHITESPACE) {
                        $index++;
                        continue;
                    }
                    $use .= $tokens[$index++][1];
                }
                $alias = null;
                if ($tokens[$index][0] == T_AS) {
                    $alias = '';
                    $index += 2;
                    while (isset($tokens[$index]) && is_array($tokens[$index])) {
                        $alias .= $tokens[$index++][1];
                    }
                }
                $uses[$use] = $use;
            }
            if (T_CLASS == $tokens[$index][0]) {
                break;
            }
        }

        return $uses;
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
