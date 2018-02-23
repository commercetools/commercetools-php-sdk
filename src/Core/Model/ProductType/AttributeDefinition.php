<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://docs.commercetools.com/http-api-projects-productTypes.html#attributedefinition
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
 * @method LocalizedString getInputTip()
 * @method AttributeDefinition setInputTip(LocalizedString $inputTip = null)
 */
class AttributeDefinition extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => AttributeType::class],
            'name' => [static::TYPE => 'string'],
            'label' => [static::TYPE => LocalizedString::class],
            'isRequired' => [static::TYPE => 'bool'],
            'attributeConstraint' => [static::TYPE => 'string'],
            'inputHint' => [static::TYPE => 'string'],
            'isSearchable' => [static::TYPE => 'bool'],
            'inputTip' => [static::TYPE => LocalizedString::class],
        ];
    }
}
