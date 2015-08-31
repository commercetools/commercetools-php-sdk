<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CustomField;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Type\TypeReference;

/**
 * @package Commercetools\Core\Model\CustomField
 *
 * @method string getTypeKey()
 * @method CustomFieldObjectDraft setTypeKey(string $typeKey = null)
 * @method FieldContainer getFields()
 * @method CustomFieldObjectDraft setFields(FieldContainer $fields = null)
 * @method string getTypeId()
 * @method CustomFieldObjectDraft setTypeId(string $typeId = null)
 */
class CustomFieldObjectDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'typeId' => [static::TYPE => 'string'],
            'typeKey' => [static::TYPE => 'string'],
            'fields' => [static::TYPE => '\Commercetools\Core\Model\CustomField\FieldContainer']
        ];
    }

    /**
     * @param $typeKey
     * @param Context|callable $context
     * @return CustomFieldObjectDraft
     */
    public static function ofTypeKey($typeKey, $context = null)
    {
        $draft = static::of($context)->setTypeKey($typeKey);

        return $draft;
    }

    public static function ofType(TypeReference $type, $context = null)
    {
        $draft = static::of($context)->setType($type);

        return $draft;
    }
}
