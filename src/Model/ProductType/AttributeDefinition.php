<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Type\FieldDefinition;
use Commercetools\Core\Model\Type\FieldType;

/**
 * @package Commercetools\Core\Model\ProductType
 * @apidoc http://dev.sphere.io/http-api-projects-productTypes.html#attribute-definition
 * @method FieldType getType()
 * @method AttributeDefinition setType(FieldType $type = null)
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
class AttributeDefinition extends FieldDefinition
{
    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => '\Commercetools\Core\Model\Type\FieldType'],
            'name' => [static::TYPE => 'string'],
            'label' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'isRequired' => [static::TYPE => 'bool'],
            'attributeConstraint' => [static::TYPE => 'string'],
            'inputHint' => [static::TYPE => 'string'],
            'isSearchable' => [static::TYPE => 'bool'],
        ];
    }
}
