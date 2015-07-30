<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\ProductType
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
    protected $attributeValuesType = '\Commercetools\Core\Model\Common\Collection';

    public function getFields()
    {
        return [
            'name' => [static::TYPE => 'string'],
            'values' => [static::TYPE => $this->attributeValuesType],
            'referenceTypeId' => [static::TYPE => 'string'],
            'elementType' => [static::TYPE => '\Commercetools\Core\Model\ProductType\AttributeType'],
            'typeReference' => [static::TYPE => '\Commercetools\Core\Model\ProductType\ProductTypeReference']
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
                return '\Commercetools\Core\Model\Common\EnumCollection';
            case "lenum":
                return '\Commercetools\Core\Model\Common\LocalizedEnumCollection';
        }
        return '\Commercetools\Core\Model\Common\Collection';
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
