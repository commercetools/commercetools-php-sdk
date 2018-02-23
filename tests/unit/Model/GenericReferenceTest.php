<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Reference;

/**
 * Class GenericReferenceTest
 * @package Commercetools\Core\Model
 */
class GenericReferenceTest extends AbstractModelTest
{
    protected $fixture = 'references.yaml';

    protected function getInstance($className)
    {
        $class = new \ReflectionClass($className);
        if (!$class->isAbstract()) {
            $object = call_user_func_array($className . '::ofId', ['123456']);
        } else {
            $object = $this->getMockForAbstractClass($className, ['test-type', '123456'], '', false);
        }

        return $object;
    }

    /**
     * @dataProvider fieldProvider
     * @param string $domain
     * @param string $model
     */
    public function testValidProperties($domain, $model)
    {
        $validFields = ['typeId', 'id', 'obj', 'key'];
        $className = $this->getClassName($domain, $model);
        $object = $this->getInstance($className);

        $validFields = array_flip($validFields);
        foreach ($object->fieldDefinitions() as $fieldKey => $field) {
            $this->assertArrayHasKey(
                $fieldKey,
                $validFields,
                sprintf('Failed asserting that \'%s\' is a valid field at \'%s\'', $fieldKey, $className)
            );
        }
    }

    /**
     * @dataProvider fieldProvider
     * @param string $domain
     * @param string $model
     */
    public function testPropertiesExist($domain, $model)
    {
        $validFields = ['typeId', 'id', 'obj'];
        $className = $this->getClassName($domain, $model);
        $object = $this->getInstance($className);

        foreach ($validFields as $fieldKey) {
            $this->assertArrayHasKey(
                $fieldKey,
                $object->fieldDefinitions(),
                sprintf('Failed asserting that \'%s\' has a field \'%s\'', $className, $fieldKey)
            );
        }
    }

    /**
     * @dataProvider fieldProvider
     * @param $domain
     * @param $model
     * @param $typeId
     */
    public function testTypeId($domain, $model, $typeId)
    {
        $className = $this->getClassName($domain, $model);
        /**
         * @var Reference $object
         */
        $object = $this->getInstance($className);
        $this->assertSame($typeId, $object->getTypeId());
    }

    /**
     * @dataProvider fieldProvider
     * @param $domain
     * @param $model
     * @param $typeId
     * @param $obj
     */
    public function testObject($domain, $model, $typeId, $obj)
    {
        $className = $this->getClassName($domain, $model);
        $objClassName = $this->getClassName($obj['domain'], $obj['model']);

        /**
         * @var Reference $object
         */
        $object = $this->getInstance($className);
        $this->assertSame($objClassName, $object->fieldDefinitions()['obj'][JsonObject::TYPE]);
    }
}
