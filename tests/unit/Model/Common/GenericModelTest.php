<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


use Symfony\Component\Yaml\Yaml;

class GenericModelTest extends \PHPUnit_Framework_TestCase
{
    protected $modelFields;

    public function modelFieldProvider()
    {
        if (is_null($this->modelFields)) {
            $fixturePath = __DIR__ . '/../../../fixtures/';
            $this->modelFields = Yaml::parse(file_get_contents($fixturePath . 'models.yaml'));
        }

        return $this->modelFields;
    }

    protected function getInstance($className)
    {
        $class = new \ReflectionClass($className);
        if (!$class->isAbstract()) {
            $object = $class->newInstanceWithoutConstructor();
        } else {
            $object = $this->getMockForAbstractClass($className, [], '', false);
        }

        return $object;
    }

    protected function getClassName($domain, $model)
    {
        return '\Sphere\Core\Model\\' . ucfirst($domain) . '\\' . ucfirst($model);
    }

    /**
     * @dataProvider modelFieldProvider
     * @param string $domain
     * @param string $model
     * @param array $validFields
     */
    public function testValidProperties($domain, $model, array $validFields = [])
    {
        $className = $this->getClassName($domain, $model);
        $object = $this->getInstance($className);

        $validFields = array_flip($validFields);
        foreach ($object->getFields() as $fieldKey => $field) {
            $this->assertArrayHasKey(
                $fieldKey,
                $validFields,
                sprintf('Failed asserting that \'%s\' is a valid field at \'%s\'', $fieldKey, $className)
            );
        }
    }

    /**
     * @dataProvider modelFieldProvider
     * @param string $domain
     * @param string $model
     * @param array $validFields
     */
    public function testPropertiesExist($domain, $model, array $validFields = [])
    {
        $className = $this->getClassName($domain, $model);
        $object = $this->getInstance($className);

        foreach ($validFields as $fieldKey) {
            $this->assertArrayHasKey(
                $fieldKey,
                $object->getFields(),
                sprintf('Failed asserting that \'%s\' has a field \'%s\'', $className, $fieldKey)
            );
        }
    }
}
