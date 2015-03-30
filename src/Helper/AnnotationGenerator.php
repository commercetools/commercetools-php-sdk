<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Helper;


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
            $this->reflectionClass = new \ReflectionClass($jsonObject);
            if ($this->reflectionClass->isAbstract()) {
                continue;
            }

            $this->generateJsonObjectAnnotations($jsonObject);
        }
    }

    protected function getJsonObjects(\RegexIterator $phpFiles)
    {
        $jsonObjects = [];
        foreach ($phpFiles as $phpFile) {
            $class = $this->getClassName($phpFile->getRealPath());

            if (!empty($class)) {
                if (in_array('Sphere\Core\Model\Common\JsonObject', class_parents($class))) {
                    $jsonObjects[] = $class;
                }
            }
        }

        return $jsonObjects;
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

    protected function getMethodPattern()
    {
        return '~@method\\s+(?:([$\\w\\\\]+(?:\\|[$\\w\\\\]+)*)\\s+)?(&)?' .
        '\\s*((set|get)(\\w+))\\s*\\(\\s*(.*)\\s*\\)\\s*(.*|$)~s';
    }

    /**
     * @param string[] $matches
     */
    protected function analyzeMethod($matches)
    {
        list(,,,, $type, $fieldName,,) = $matches;
        $fieldName = lcfirst($fieldName);
        $methodName = $type . ucfirst($fieldName);

        if ($this->reflectionClass->hasMethod($methodName)) {
            return;
        }

        $this->fieldNames[$fieldName][$type] = $fieldName;
        if (isset($this->fields[$fieldName])) {
            $field = $this->fields[$fieldName];
            $fieldType = '';
            if (isset($field['type'])) {
                $classParts = explode('\\', trim($field['type'], '\\'));
                if (count($classParts) == 1) {
                    $fieldType = $field['type'];
                } else {
                    $fieldType = trim($field['type'], '\\');
                    if (strpos($fieldType, $this->reflectionClass->getNamespaceName() . '\\') === false) {
                        $this->uses[$fieldType] = $fieldType;
                    }
                    $fieldClassName = array_pop($classParts);
                    $fieldType = $fieldClassName;
                }
            }
            if (!isset($field['optional'])) {
                $optional = ' = null';
            } elseif (isset($field['optional']) && $field['optional'] == true) {
                $optional = ' = null';
            } else {
                $optional = '';
            }
            $classParts = explode('\\', $this->reflectionClass->getName());
            $className = array_pop($classParts);
            if ($type == 'get') {
                if (isset($field['decorator'])) {
                    $this->uses[$field['decorator']] = $field['decorator'];
                    $classParts = explode('\\', trim($field['decorator'], '\\'));
                    $fieldType = array_pop($classParts);
                }
                $this->newDocBlock[] = ' * @method ' . ($fieldType? $fieldType . ' ':'') . $methodName . '()';
            } else {
                $this->newDocBlock[] = ' * @method ' . $className . ' ' . $methodName .
                    '(' . ($fieldType? $fieldType . ' ':'') . '$' . $fieldName . $optional .')';
            }
        }
    }
    protected function analyzeDocBlockLine($line)
    {
        if (strpos($line, '@package') > 0) {
            $this->newDocBlock[] = ' * @package ' . $this->reflectionClass->getNamespaceName();
        } elseif (strpos($line, '* Class') > 0) {
            $this->newDocBlock[] = ' * Class ' . $this->reflectionClass->getShortName();
        } elseif (preg_match($this->getMethodPattern(), $line, $matches)) {
            $this->analyzeMethod($matches);
        } else {
            $this->newDocBlock[] = $line;
        }
    }

    protected function analyzeDocBlock()
    {
        $docBlockLines = explode(PHP_EOL, $this->reflectionClass->getDocComment());

        foreach ($docBlockLines as $line) {
            $this->analyzeDocBlockLine($line);
        }
        $firstLine = current($this->newDocBlock);
        if ($firstLine != '/**') {
            array_unshift($this->newDocBlock, '/**');
        }

        return $this->newDocBlock;

    }
    protected function generateJsonObjectAnnotations($jsonObject)
    {
        $this->reflectionClass = new \ReflectionClass($jsonObject);

        $reflectionMethod = $this->reflectionClass->getMethod('getFields');
        $object = $this->reflectionClass->newInstanceWithoutConstructor();
        $this->fields = $reflectionMethod->invoke($object);

        $this->newDocBlock = [];
        $this->fieldNames = [];
        $this->uses = [];
        $this->includes = [];

        $this->analyzeDocBlock();
        $lastLine = array_pop($this->newDocBlock);

        $this->includes[] = 'namespace ' . $this->reflectionClass->getNamespaceName() . ';';
        $this->includes[] = '';

        foreach ($this->fields as $fieldName => $field) {
            $fieldType = '';
            if (isset($field['type'])) {
                $classParts = explode('\\', trim($field['type'], '\\'));
                if (count($classParts) == 1) {
                    $fieldType = $field['type'];
                } else {
                    $fieldType = trim($field['type'], '\\');
                    if (strpos($fieldType, $this->reflectionClass->getNamespaceName() . '\\') === false) {
                        $this->uses[$fieldType] = $fieldType;
                    }
                    $fieldClassName = array_pop($classParts);
                    $fieldType = $fieldClassName;
                }
            }
            if (!isset($field['optional'])) {
                $optional = ' = null';
            } elseif (isset($field['optional']) && $field['optional'] == true) {
                $optional = ' = null';
            } else {
                $optional = '';
            }
            if (!isset($this->fieldNames[$fieldName]['get'])) {
                if (isset($field['decorator'])) {
                    $this->uses[$field['decorator']] = $field['decorator'];
                    $classParts = explode('\\', trim($field['decorator'], '\\'));
                    $fieldType = array_pop($classParts);
                }

                $methodName = 'get' . ucfirst($fieldName);
                if ($this->reflectionClass->hasMethod($methodName)) {
                    continue;
                }
                $this->newDocBlock[] = ' * @method ' . ($fieldType? $fieldType . ' ':'') . $methodName . '()';
            }
            if (!isset($this->fieldNames[$fieldName]['set'])) {
                $classParts = explode('\\', trim($jsonObject, '\\'));
                if (count($classParts) == 1) {
                    $className = $field['type'];
                } else {
                    $className = array_pop($classParts);
                }

                $methodName = 'set' . ucfirst($fieldName);
                if ($this->reflectionClass->hasMethod($methodName)) {
                    continue;
                }
                $this->newDocBlock[] = ' * @method ' . $className . ' ' . $methodName .
                    '(' . ($fieldType? $fieldType . ' ':'') . '$' . $fieldName . $optional . ')';
            }
        }
        if (empty($lastLine)) {
            $lastLine = ' */';
        }
        array_push($this->newDocBlock, $lastLine);

        $fileName = $this->reflectionClass->getFileName();

        $source = file_get_contents($fileName);

        preg_match('~namespace(.*)class~s', $source, $matches);
        $headData = $matches[1];
        preg_match_all('~use (.*);\n~', $headData, $matches);
        if (isset($matches[1])) {
            foreach ($matches[1] as $match) {
                $data = explode(' as ', $match);
                $this->uses[$data[0]] = $data[0] . (isset($data[1]) ? ' as ' . $data[1] : '');
            }
        }

        $head  = implode(PHP_EOL, $this->includes) . PHP_EOL;
        ksort($this->uses);
        foreach ($this->uses as $use) {
            if (!$this->isPrimitive($use)) {
                $head .= 'use ' . $use . ';' . PHP_EOL;
            }
        }
        $head .= PHP_EOL . implode(PHP_EOL, $this->newDocBlock);

        $newSource = preg_replace(
            '~(?:(namespace.*/))(?:.*)/(.*)(?:\s+class)~s',
            $head . PHP_EOL . 'class',
            $source
        );
        file_put_contents($fileName, $newSource);
    }

    protected function isPrimitive($type)
    {
        $primitives = [
            'bool' => 'is_bool',
            'int' => 'is_int',
            'string' => 'is_string',
            'float' => 'is_float',
            'array' => 'is_array'
        ];
        if (!isset($primitives[$type])) {
            return false;
        }

        return $primitives[$type];
    }
}
