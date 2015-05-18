<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ProductType;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\Collection;

/**
 * Class AttributeType
 * @package Sphere\Core\Model\ProductType
 * @link http://dev.sphere.io/http-api-projects-productTypes.html#attribute-type
 * @method string getName()
 * @method AttributeType setName(string $name = null)
 * @method Collection getValues()
 * @method AttributeType setValues(Collection $values = null)
 * @method string getReferenceTypeId()
 * @method AttributeType setReferenceTypeId(string $referenceTypeId = null)
 * @method AttributeType getElementType()
 * @method AttributeType setElementType(AttributeType $elementType = null)
 * @method ProductTypeReference getTypeReference()
 * @method AttributeType setTypeReference(ProductTypeReference $typeReference = null)
 */
class AttributeType extends JsonObject
{
    public function getFields()
    {
        return [
            'name' => [static::TYPE => 'string'],
            'values' => [static::TYPE => '\Sphere\Core\Model\Common\Collection'],
            'referenceTypeId' => [static::TYPE => 'string'],
            'elementType' => [static::TYPE => '\Sphere\Core\Model\ProductType\AttributeType'],
            'typeReference' => [static::TYPE => '\Sphere\Core\Model\ProductType\ProductTypeReference']
        ];
    }

    /**
     * @param string $name
     */
    protected function setValuesType($name)
    {
        switch ($name) {
            case "enum":
                $this->getValues()->setType('\Sphere\Core\Model\Common\Enum');
                break;
            case "lenum":
                $this->getValues()->setType('\Sphere\Core\Model\Common\LocalizedEnum');
                break;
        }
    }

    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        $type = new static($data, $context);
        if (isset($data['name'])) {
            $type->setValuesType($data['name']);
        }
        return $type;
    }
}
