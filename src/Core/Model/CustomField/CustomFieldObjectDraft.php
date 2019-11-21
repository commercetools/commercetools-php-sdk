<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CustomField;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\Common\ResourceIdentifier;

/**
 * @package Commercetools\Core\Model\CustomField
 * @link https://docs.commercetools.com/http-api-projects-custom-fields.html#customfieldsdraft
 * @method FieldContainer getFields()
 * @method CustomFieldObjectDraft setFields(FieldContainer $fields = null)
 * @method TypeReference getType()
 * @method CustomFieldObjectDraft setType(TypeReference $type = null)
 */
class CustomFieldObjectDraft extends CustomFieldObject
{
    /**
     * @param $typeKey
     * @param Context|callable $context
     * @return CustomFieldObjectDraft
     */
    public static function ofTypeKey($typeKey, $context = null)
    {
        $draft = static::of($context)->setType(TypeReference::ofKey($typeKey));

        return $draft;
    }

    /**
     * @param string $typeKey
     * @param FieldContainer $fields
     * @param Context|callable $context
     * @return CustomFieldObjectDraft
     */
    public static function ofTypeKeyAndFields($typeKey, FieldContainer $fields, $context = null)
    {
        return static::of($context)
            ->setType(TypeReference::ofKey($typeKey))
            ->setFields($fields);
    }

    /**
     * @param string $typeId
     * @param Context|callable $context
     * @return CustomFieldObjectDraft
     */
    public static function ofTypeId($typeId, $context = null)
    {
        $draft = static::of($context)->setType(TypeReference::ofId($typeId));

        return $draft;
    }

    /**
     * @param TypeReference $type
     * @param Context|callable $context
     * @return CustomFieldObjectDraft
     */
    public static function ofType(TypeReference $type, $context = null)
    {
        $draft = static::of($context)->setType($type);

        return $draft;
    }

    /**
     * @param TypeReference $type
     * @param FieldContainer $fields
     * @param Context|callable $context
     * @return CustomFieldObjectDraft
     */
    public static function ofTypeAndFields(TypeReference $type, FieldContainer $fields, $context = null)
    {
        return static::of($context)
            ->setType($type)
            ->setFields($fields);
    }
}
