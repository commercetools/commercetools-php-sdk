<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ProductType;

use Sphere\Core\Model\Common\JsonObject;

/**
 * Class AttributeType
 * @package Sphere\Core\Model\ProductType
 * @method string getName()
 * @method AttributeType setName(string $name = null)
 * @method getValues()
 * @method AttributeType setValues($values = null)
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
            'values' => [],
            'referenceTypeId' => [static::TYPE => 'string'],
            'elementType' => [static::TYPE => '\Sphere\Core\Model\ProductType\AttributeType'],
            'typeReference' => [static::TYPE => '\Sphere\Core\Model\ProductType\ProductTypeReference']
        ];
    }
}
