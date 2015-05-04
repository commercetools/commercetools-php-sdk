<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ProductType;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\LocalizedString;

/**
 * Class AttributeDefinition
 * @package Sphere\Core\Model\ProductType
 * @link http://dev.sphere.io/http-api-projects-productTypes.html#attribute-definition
 * @method AttributeType getType()
 * @method AttributeDefinition setType(AttributeType $type = null)
 * @method string getName()
 * @method AttributeDefinition setName(string $name = null)
 * @method LocalizedString getLabel()
 * @method AttributeDefinition setLabel(LocalizedString $label = null)
 * @method bool getIsRequired()
 * @method AttributeDefinition setIsRequired(bool $isRequired = null)
 * @method string getAttributeConstraint()
 * @method AttributeDefinition setAttributeConstraint(string $attributeConstraint = null)
 * @method string getInputHint()
 * @method AttributeDefinition setInputHint(string $inputHint = null)
 * @method bool getIsSearchable()
 * @method AttributeDefinition setIsSearchable(bool $isSearchable = null)
 */
class AttributeDefinition extends JsonObject
{
    public function getFields()
    {
        return [
            'type' => [static::TYPE => '\Sphere\Core\Model\ProductType\AttributeType'],
            'name' => [static::TYPE => 'string'],
            'label' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'isRequired' => [static::TYPE => 'bool'],
            'attributeConstraint' => [static::TYPE => 'string'],
            'inputHint' => [static::TYPE => 'string'],
            'isSearchable' => [static::TYPE => 'bool'],
        ];
    }
}
