<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CustomField;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Type\TypeReference;

/**
 * @package Commercetools\Core\Model\CustomField
 * @link https://dev.commercetools.com/http-api-projects-custom-fields.html#custom
 * @method TypeReference getType()
 * @method CustomFieldObject setType(TypeReference $type = null)
 * @method CustomFieldObject setFields(FieldContainer $fields = null)
 * @method FieldContainer getFields()
 */
class CustomFieldObject extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => '\Commercetools\Core\Model\Type\TypeReference'],
            'fields' => [static::TYPE => '\Commercetools\Core\Model\CustomField\FieldContainer']
        ];
    }
}
