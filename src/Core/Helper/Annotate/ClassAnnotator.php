<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Helper\Annotate;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\MapperInterface;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use DateTime;

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
    }

    /**
     * @return array
     */
    protected function reflectFields()
    {
        $reflectionClass = new \ReflectionClass($this->class->getClassName());
        if (!$reflectionClass->hasMethod('fieldDefinitions')) {
            return;
        }
        $reflectionMethod = $reflectionClass->getMethod('fieldDefinitions');

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
                if (empty($fieldType)) {
                    $getReturnType = 'mixed';
                } else {
                    $getReturnType = $fieldType;
                }
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
            if (!$this->isPrimitive($fieldType) &&
                (count($fieldTypeParts) > 1 || trim($fieldType, '\\') == DateTime::class)
            ) {
                $this->class->addUse($fieldType);
                $fieldType = array_pop($fieldTypeParts);
            }

            $args = [trim($fieldType . ' $' . $fieldName . $optional)];

            $this->class->addMagicGetSetMethod('get', $fieldName, [], $getReturnClassName);
            $this->class->addMagicGetSetMethod('set', $fieldName, $args, $this->class->getShortClassName());
        }
    }

    protected function reflectReference()
    {
        $reflectionClass = new \ReflectionClass($this->class->getClassName());
        if (!$reflectionClass->isSubclassOf(Resource::class)) {
            return;
        }

        $referenceClass = $this->class->getClassName() . 'Reference';
        $referenceShortName = $this->class->getShortClassName() . 'Reference';
        if (class_exists($referenceClass)) {
            $this->class->addMagicMethod(
                'getReference',
                [],
                $referenceShortName,
                null,
                null,
                false,
                true
            );
        }
    }

    protected function reflectElementType()
    {
        $reflectionClass = new \ReflectionClass($this->class->getClassName());
        if (!$reflectionClass->hasMethod('getType')) {
            return;
        }
        $reflectionMethod = $reflectionClass->getMethod('getType');

        $classObject = $reflectionClass->newInstanceWithoutConstructor();
        $elementType = $reflectionMethod->invoke($classObject);

        if ($elementType && !$this->isPrimitive($elementType)) {
            $elementTypeClass = new \ReflectionClass($elementType);
            $this->class->addUse($elementType);
            $getAtMethod = $reflectionClass->getMethod('getAt');
            if ($getAtMethod->class != $this->class->getClassName()) {
                $this->class->addMagicMethod(
                    'getAt',
                    ['$offset'],
                    $elementTypeClass->getShortName(),
                    null,
                    null,
                    false,
                    true
                );
            }
            $getByIdMethod = $reflectionClass->getMethod('getById');
            if ($getByIdMethod->class != $this->class->getClassName()) {
                $elementTypeObject = $elementTypeClass->newInstanceWithoutConstructor();
                if ($elementTypeObject instanceof JsonObject && isset($elementTypeObject->fieldDefinitions()['id'])) {
                    $this->class->addMagicMethod(
                        'getById',
                        ['$offset'],
                        $elementTypeClass->getShortName(),
                        null,
                        null,
                        false,
                        true
                    );
                }
            }
            $addMethod = $reflectionClass->getMethod('add');
            if ($addMethod->class != $this->class->getClassName()) {
                $this->class->addMagicMethod(
                    'add',
                    [$elementTypeClass->getShortName() . ' $element'],
                    $reflectionClass->getShortName(),
                    null,
                    null,
                    false,
                    true
                );
            }
            $current = $reflectionClass->getMethod('current');
            if ($current->class != $this->class->getClassName()) {
                $this->class->addMagicMethod(
                    'current',
                    [],
                    $elementTypeClass->getShortName(),
                    null,
                    null,
                    false,
                    true
                );
            }
        }
    }

    protected function reflectResultClass()
    {
        $reflectionClass = new \ReflectionClass($this->class->getClassName());
        if (!$reflectionClass->hasMethod('getResultClass')) {
            return;
        }
        $reflectionMethod = $reflectionClass->getMethod('getResultClass');

        $classObject = $reflectionClass->newInstanceWithoutConstructor();
        $resultClass = $reflectionMethod->invoke($classObject);

        $resultClassReflection = new \ReflectionClass($resultClass);
        $this->class->addUse($resultClass);
        $mapResponseMethod = $reflectionClass->getMethod('mapResponse');
        if ($mapResponseMethod->class != $this->class->getClassName()) {
            $this->class->addUse(ApiResponseInterface::class);
            $this->class->addMagicMethod(
                'mapResponse',
                ['ApiResponseInterface $response'],
                $resultClassReflection->getShortName(),
                null,
                null,
                false,
                true
            );
            $this->class->addUse(MapperInterface::class);
            $this->class->addMagicMethod(
                'mapFromResponse',
                ['ApiResponseInterface $response', 'MapperInterface $mapper = null'],
                $resultClassReflection->getShortName(),
                null,
                null,
                false,
                true
            );
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

        $this->reflectFields();
        $this->reflectReference();
        $this->annotate();
    }

    public function generateCurrentMethod()
    {
        if ($this->class->isAbstract()) {
            return;
        }

        $this->reflectElementType();
        $this->annotate();
    }

    public function generateMapResponseMethod()
    {
        if ($this->class->isAbstract()) {
            return;
        }

        $this->reflectResultClass();
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

        if (count($this->class->getUses()) > 0) {
            $classHead[] = '';
        }

        foreach ($this->class->getUses() as $use) {
            $classHead[] = 'use ' . $use['class'] . (isset($use['alias']) ? ' as ' . $use['alias'] : '') . ';';
        }
        $classHead[] = '';
        $classHead[] = '/**';
        $classHead[] = ' * @package ' . $this->class->getNamespace();
        $docBlockLines = $this->class->getDocBlockLines();
        foreach ($docBlockLines as $lineNr => $line) {
            if ($this->ignoreDocBlockLine($lineNr, $docBlockLines)) {
                continue;
            }
            $classHead[] = ' *' . (empty($line) ? '' : ' ' . $line);
        }

        foreach ($this->class->getMagicGetSetMethods() as $magicMethod) {
            $method = (isset($magicMethod['static']) && $magicMethod['static'] ? 'static ' : '');
            $method.= $magicMethod['returnTypeHint'] . ' ' . $magicMethod['name'];
            $method.= '(' . implode(', ', $magicMethod['args']) . ')';
            $methodString = ' * @method ' . trim($method);

            if (strlen($methodString) >= 120) {
                $classHead[] = ' * @codingStandardsIgnoreStart';
                $classHead[] = $methodString;
                $classHead[] = ' * @codingStandardsIgnoreEnd';
            } else {
                $classHead[] = $methodString;
            }
        }
        $classHead[] = ' */';

        $fileName = $this->class->getFileName();

        $source = file_get_contents($fileName);

        $newSource = preg_replace(
            '~namespace(.*)class ' . $this->class->getShortClassName() . '~s',
            implode(PHP_EOL, $classHead) . PHP_EOL . 'class ' . $this->class->getShortClassName(),
            $source
        );

        file_put_contents($fileName, $newSource);
    }

    protected function ignoreDocBlockLine($lineNr, $lines)
    {
        if (isset($lines[$lineNr+1]) &&
            strpos($lines[$lineNr], '@codingStandardsIgnoreStart') !== false &&
            strpos($lines[$lineNr+1], '@codingStandardsIgnoreEnd') !== false
        ) {
            return true;
        }
        if (isset($lines[$lineNr-1]) &&
            strpos($lines[$lineNr], '@codingStandardsIgnoreEnd') !== false &&
            strpos($lines[$lineNr-1], '@codingStandardsIgnoreStart') !== false
        ) {
            return true;
        }

        return false;
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
