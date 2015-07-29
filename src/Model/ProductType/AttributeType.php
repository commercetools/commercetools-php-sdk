<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ProductType;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\Collection;

/**
 * @package Sphere\Core\Model\ProductType
 * @apidoc http://dev.sphere.io/http-api-projects-productTypes.html#attribute-type
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
    protected $attributeValuesType = '\Sphere\Core\Model\Common\Collection';

    public function getFields()
    {
        return [
            'name' => [static::TYPE => 'string'],
            'values' => [static::TYPE => $this->attributeValuesType],
            'referenceTypeId' => [static::TYPE => 'string'],
            'elementType' => [static::TYPE => '\Sphere\Core\Model\ProductType\AttributeType'],
            'typeReference' => [static::TYPE => '\Sphere\Core\Model\ProductType\ProductTypeReference']
        ];
    }

    /**
     * @param string $name
     * @return string
     */
    protected function getValuesType($name)
    {
        switch ($name) {
            case "enum":
                return '\Sphere\Core\Model\Common\EnumCollection';
            case "lenum":
                return '\Sphere\Core\Model\Common\LocalizedEnumCollection';
        }
        return '\Sphere\Core\Model\Common\Collection';
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        if (isset($data['name'])) {
            $this->attributeValuesType = $this->getValuesType($data['name']);
        }
        parent::__construct($data, $context);
    }
}
