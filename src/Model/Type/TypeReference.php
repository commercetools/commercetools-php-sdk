<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Type
 * @method string getTypeId()
 * @method TypeReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method TypeReference setId(string $id = null)
 * @method Type getObj()
 * @method TypeReference setObj(Type $obj = null)
 * @method string getKey()
 * @method TypeReference setKey(string $key = null)
 */
class TypeReference extends Reference
{
    const TYPE_TYPE = 'type';
    const TYPE_CLASS = '\Commercetools\Core\Model\Type\Type';

    /**
     * @param $id
     * @param Context|callable $context
     * @return TypeReference
     */
    public static function ofId($id, $context = null)
    {
        $test = static::ofTypeAndId(static::TYPE_TYPE, $id, $context);
        return $test;
    }

    /**
     * @param $key
     * @param Context|callable $context
     * @return TypeReference
     */
    public static function ofKey($key, $context = null)
    {
        return static::ofTypeAndKey(static::TYPE_TYPE, $key, $context);
    }
}
