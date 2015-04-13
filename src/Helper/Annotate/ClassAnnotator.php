<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Helper\Annotate;

use Sphere\Core\Model\Common\JsonObject;

class ClassAnnotator
{
    /**
     * @var ReflectedClass
     */
    protected $class;

    protected $fields;

    public function __construct($className)
    {
        $this->class = new ReflectedClass($className);
        $this->reflect();
    }

    /**
     *
     */
    public function reflect()
    {
        if ($this->class->isAbstract()) {
            return;
        }

        $this->reflectFields();
    }


    /**
     * @return array
     */
    protected function reflectFields()
    {
        $reflectionClass = new \ReflectionClass($this->class->getClassName());
        $reflectionMethod = $reflectionClass->getMethod('getFields');

        $classObject = $reflectionClass->newInstanceWithoutConstructor();
        $this->fields = $reflectionMethod->invoke($classObject);

        foreach ($this->fields as $fieldName => $field) {
            $fieldType = '';
            if (isset($field[JsonObject::TYPE])) {
                $fieldType = $field[JsonObject::TYPE];
            }
            if (isset($field[JsonObject::DECORATOR])) {
                $getReturnType = $field[JsonObject::DECORATOR];
                $this->class->addUse($field[JsonObject::DECORATOR]);
            } else {
                $getReturnType = $fieldType;
            }
            $getReturnTypeParts = explode('\\', trim($getReturnType, '\\'));
            if (!$this->isPrimitive($fieldType) && count($getReturnTypeParts) > 1) {
                $getReturnClassName = array_pop($getReturnTypeParts);
            } else {
                $getReturnClassName = $getReturnType;
            }
            if ($this->isOptional($field)) {
                $optional = ' = null';
            } else {
                $optional = '';
            }

            $fieldTypeParts = explode('\\', trim($fieldType, '\\'));
            if (!$this->isPrimitive($fieldType) && count($fieldTypeParts) > 1) {
                $this->class->addUse($fieldType);
                $fieldType = array_pop($fieldTypeParts);
            }

            $args = [trim($fieldType . ' $' . $fieldName . $optional)];

            $this->class->addMagicGetSetMethod('get', $fieldName, [], $getReturnClassName);
            $this->class->addMagicGetSetMethod('set', $fieldName, $args, $this->class->getShortClassName());
        }
    }

    /**
     *
     */
    public function generate()
    {
        if ($this->class->isAbstract()) {
            return;
        }

        $this->annotate();
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


    protected function annotate()
    {
        $classHead = [];
        $classHead[] = 'namespace ' . $this->class->getNamespace() . ';';
        $classHead[] = '';

        foreach ($this->class->getUses() as $use) {
            $classHead[] = 'use ' . $use['class'] . (isset($use['alias']) ? ' as ' . $use['alias'] : '') . ';';
        }
        $classHead[] = '';
        $classHead[] = '/**';

        $classHead[] = ' * Class ' . $this->class->getShortClassName();
        $classHead[] = ' * @package ' . $this->class->getNamespace();
        foreach ($this->class->getDocBlockLines() as $line) {
            $classHead[] = ' * ' . $line;
        }

        foreach ($this->class->getMagicGetSetMethods() as $magicMethod) {
            $method = $magicMethod['returnTypeHint'] . ' ' . $magicMethod['name'];
            $method.= '(' . implode(', ', $magicMethod['args']) . ')';
            $classHead[] = ' * @method ' . trim($method);
        }
        $classHead[] = ' */';

        if ($this->class->getShortClassName() == 'Attribute') {
            $fileName = $this->class->getFileName();

            $source = file_get_contents($fileName);

            $newSource = preg_replace(
                '~namespace(.*)class~s',
                implode(PHP_EOL, $classHead) . PHP_EOL . 'class',
                $source
            );

            file_put_contents($fileName, $newSource);
        }
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

        return isset($primitives[$type]);
    }
}
