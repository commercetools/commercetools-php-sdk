<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Commercetools\Core\Model\Subscription;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Subscription
 * @link https://dev.commercetools.com/http-api-types.html#reference-types
 * @link https://dev.commercetools.com/http-api-projects-subscriptions.html#subscription
 * @method string getTypeId()
 * @method SubscriptionReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method SubscriptionReference setId(string $id = null)
 * @method string getKey()
 * @method SubscriptionReference setKey(string $key = null)
 * @method Subscription getObj()
 * @method SubscriptionReference setObj(Subscription $obj = null)
 */
class SubscriptionReference extends Reference
{
    const TYPE_SUBSCRIPTION = 'subscription';
    const TYPE_CLASS = '\Commercetools\Core\Model\Subscription\Subscription';

    /**
     * @param $id
     * @param Context|callable $context
     * @return SubscriptionReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_SUBSCRIPTION, $id, $context);
    }

    /**
     * @param $key
     * @param Context|callable $context
     * @return SubscriptionReference
     */
    public static function ofKey($key, $context = null)
    {
        return static::ofTypeAndKey(static::TYPE_SUBSCRIPTION, $key, $context);
    }
}
