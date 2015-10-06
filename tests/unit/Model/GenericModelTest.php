<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model;

use Symfony\Component\Yaml\Yaml;

class GenericModelTest extends AbstractModelTest
{
    /**
     * @dataProvider fieldProvider
     * @param string $domain
     * @param string $model
     * @param array $validFields
     */
    public function testValidProperties($domain, $model, array $validFields = [])
    {
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
     * @param array $validFields
     */
    public function testPropertiesExist($domain, $model, array $validFields = [])
    {
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
}
