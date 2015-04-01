<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Helper;


class ClassAnnotator
{
    /**
     * @var \ReflectionClass
     */
    protected $reflectionClass;

    protected $fields;

    protected $fieldAccessors = [];

    protected $uses = [];

    protected $includes = [];

    public function __construct($className)
    {
        $this->reflectionClass = new \ReflectionClass($className);
    }

    /**
     *
     */
    public function generate()
    {
        if ($this->reflectionClass->isAbstract()) {
            return;
        }

        $this->annotate();
    }

    /**
     * @param $type
     * @param $fieldName
     */
    protected function setFieldAccessor($type, $fieldName)
    {
        $this->fieldAccessors[$fieldName][$type] = $fieldName;

        return $this;
    }

    /**
     * @param $type
     * @param $fieldName
     * @return bool
     */
    public function hasFieldAccesssor($type, $fieldName)
    {
        return isset($this->fieldAccessors[$fieldName][$type]);
    }

    /**
     * @return array
     */
    protected function getFields()
    {
        if (is_null($this->fields)) {
            $reflectionMethod = $this->reflectionClass->getMethod('getFields');

            $object = $this->reflectionClass->newInstanceWithoutConstructor();
            $this->fields = $reflectionMethod->invoke($object);
        }

        return $this->fields;
    }

    /**
     * @param $fieldName
     * @return array
     */
    protected function getField($fieldName)
    {
        return $this->getFields()[$fieldName];
    }

    /**
     * @param $fieldName
     * @return bool
     */
    protected function hasField($fieldName)
    {
        return isset($this->getFields()[$fieldName]);
    }

    /**
     * @return string
     */
    protected function getMethodPattern()
    {
        return '~@method\\s+(?:([$\\w\\\\]+(?:\\|[$\\w\\\\]+)*)\\s+)?(&)?' .
        '\\s*((set|get)(\\w+))\\s*\\(\\s*(.*)\\s*\\)\\s*(.*|$)~s';
    }

    /**
     * @param $line
     * @return null|string
     */
    protected function analyzeDocBlockLine($line)
    {
        if (strpos($line, '@package') > 0) {
            return ' * @package ' . $this->reflectionClass->getNamespaceName();
        } elseif (strpos($line, '* Class') > 0) {
            return ' * Class ' . $this->reflectionClass->getShortName();
        } elseif (preg_match($this->getMethodPattern(), $line, $matches)) {
            return $this->analyzeMethod($matches);
        }
        return $line;
    }

    /**
     * @param $docBlock
     * @return array
     */
    protected function analyzeClassDocBlock($docBlock)
    {
        $docBlockLines = explode(PHP_EOL, $docBlock);

        $lines = [];
        foreach ($docBlockLines as $line) {
            $line = $this->analyzeDocBlockLine($line);
            if (!is_null($line)) {
                $lines[] = $line;
            }
        }
        $firstLine = current($lines);
        if ($firstLine != '/**') {
            array_unshift($lines, '/**');
        }

        return $lines;
    }

    protected function getFieldType($field)
    {
        $fieldType = '';
        if (isset($field['type'])) {
            $classParts = explode('\\', trim($field['type'], '\\'));
            if (count($classParts) == 1) {
                $fieldType = $field['type'];
            } else {
                $fieldType = trim($field['type'], '\\');
                $this->addUse($fieldType);
                $fieldClassName = array_pop($classParts);
                $fieldType = $fieldClassName;
            }
        }

        return $fieldType;
    }

    /**
     * @param $fieldType
     * @param $alias
     */
    protected function addUse($fieldType, $alias = null)
    {
        if (strpos($fieldType, $this->reflectionClass->getNamespaceName() . '\\') === false) {
            $this->uses[$fieldType] = $fieldType ? : $alias;
        }
    }

    /**
     * @param $field
     * @return bool
     */
    protected function isOptional($field)
    {
        if (!isset($field['optional'])) {
            return true;
        } elseif (isset($field['optional']) && $field['optional'] == true) {
            return true;
        }

        return false;
    }

    /**
     * @param $type
     * @param $fieldName
     * @return string
     */
    protected function getMethodName($type, $fieldName)
    {
        return $type . ucfirst($fieldName);
    }

    /**
     * @param $type
     * @param $fieldName
     * @param $className
     * @return string|null
     */
    protected function getMagicMethodString($type, $fieldName, $className)
    {
        $field = $this->getField($fieldName);
        $methodName = $this->getMethodName($type, $fieldName);
        $fieldType = $this->getFieldType($field);

        if ($this->reflectionClass->hasMethod($methodName)) {
            return null;
        }
        if ($type == 'get') {
            if (isset($field['decorator'])) {
                $this->addUse($field['decorator']);
                $classParts = explode('\\', trim($field['decorator'], '\\'));
                $fieldType = array_pop($classParts);
            }
            return ' * @method ' . ($fieldType? $fieldType . ' ':'') . $methodName . '()';
        } else {
            if ($this->isOptional($field)) {
                $optional = ' = null';
            } else {
                $optional = '';
            }
            return  ' * @method ' . $className . ' ' . $methodName .
            '(' . ($fieldType? $fieldType . ' ':'') . '$' . $fieldName . $optional .')';
        }
    }

    /**
     * @param $matches
     * @return null|string
     */
    protected function analyzeMethod($matches)
    {
        list(,,,, $type, $fieldName,,) = $matches;
        $fieldName = lcfirst($fieldName);
        $methodName = $this->getMethodName($type, $fieldName);

        if ($this->reflectionClass->hasMethod($methodName)) {
            return null;
        }

        $this->setFieldAccessor($type, $fieldName);
        if ($this->hasField($fieldName)) {
            $classParts = explode('\\', $this->reflectionClass->getName());
            $className = array_pop($classParts);

            return $this->getMagicMethodString($type, $fieldName, $className);

        }

        return null;
    }

    protected function annotate()
    {
        $lines = $this->analyzeClassDocBlock($this->reflectionClass->getDocComment());

        $lastLine = array_pop($lines);

        $this->includes[] = 'namespace ' . $this->reflectionClass->getNamespaceName() . ';';
        $this->includes[] = '';


        $classParts = explode('\\', trim($this->reflectionClass->getName(), '\\'));
        $className = array_pop($classParts);
        foreach ($this->getFields() as $fieldName => $field) {
            if (!$this->hasFieldAccesssor('get', $fieldName)) {
                $line = $this->getMagicMethodString('get', $fieldName, $className);
                if (!is_null($line)) {
                    $lines[] = $line;
                }
            }
            if (!$this->hasFieldAccesssor('set', $fieldName)) {
                $line = $this->getMagicMethodString('set', $fieldName, $className);
                if (!is_null($line)) {
                    $lines[] = $line;
                }
            }
        }
        if (empty($lastLine)) {
            $lastLine = ' */';
        }
        array_push($lines, $lastLine);

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
        $head .= PHP_EOL . implode(PHP_EOL, $lines);

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
