<?php
/**
 */

namespace Commercetools\Core\Model\Store;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Store
 * @link https://docs.commercetools.com/http-api-types.html#reference-types
 * @link https://docs.commercetools.com/http-api-projects-stores#store
 *
 * @method string getTypeId()
 * @method StoreReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method StoreReference setId(string $id = null)
 * @method string getKey()
 * @method StoreReference setKey(string $key = null)
 * @method Store getObj()
 * @method StoreReference setObj(Store $obj = null)
 */
class StoreReference extends Reference
{
    const TYPE_STORE = 'store';
    const TYPE_CLASS = Store::class;

    /**
     * @param string $id
     * @param Context|callable $context
     * @return StoreReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_STORE, $id, $context);
    }

    /**
     * @param string $key
     * @param Context|callable $context
     * @return StoreReference
     */
    public static function ofKey($key, $context = null)
    {
        return static::ofTypeAndKey(static::TYPE_STORE, $key, $context);
    }
}
