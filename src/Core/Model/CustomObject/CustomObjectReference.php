<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CustomObject;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\CustomObject
 * @link https://docs.commercetools.com/http-api-types.html#reference-types
 * @method string getTypeId()
 * @method CustomObjectReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method CustomObjectReference setId(string $id = null)
 * @method string getKey()
 * @method CustomObjectReference setKey(string $key = null)
 * @method CustomObject getObj()
 * @method CustomObjectReference setObj(CustomObject $obj = null)
 */
class CustomObjectReference extends Reference
{
    const TYPE_CUSTOM_OBJECT = 'key-value-document';
    const TYPE_CLASS = CustomObject::class;

    /**
     * @param $id
     * @param Context|callable $context
     * @return CustomObjectReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_CUSTOM_OBJECT, $id, $context);
    }
}
