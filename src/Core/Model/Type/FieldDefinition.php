<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Model\Type
 * @link https://docs.commercetools.com/http-api-projects-types.html#fielddefinition
 * @method FieldType getType()
 * @method FieldDefinition setType(FieldType $type = null)
 * @method string getName()
 * @method FieldDefinition setName(string $name = null)
 * @method LocalizedString getLabel()
 * @method FieldDefinition setLabel(LocalizedString $label = null)
 * @method bool getRequired()
 * @method FieldDefinition setRequired(bool $required = null)
 * @method string getInputHint()
 * @method FieldDefinition setInputHint(string $inputHint = null)
 */
class FieldDefinition extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => FieldType::class],
            'name' => [static::TYPE => 'string'],
            'label' => [static::TYPE => LocalizedString::class],
            'required' => [static::TYPE => 'bool'],
            'inputHint' => [static::TYPE => 'string'],
        ];
    }
}
