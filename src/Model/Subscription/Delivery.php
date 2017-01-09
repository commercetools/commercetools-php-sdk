<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Subscription;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Subscription
 *
 * @method string getProjectKey()
 * @method Delivery setProjectKey(string $projectKey = null)
 * @method string getNotificationType()
 * @method Delivery setNotificationType(string $notificationType = null)
 * @method Reference getResource()
 * @method Delivery setResource(Reference $resource = null)
 */
class Delivery extends JsonObject
{
    const NOTIFICATION_TYPE = 'notificationType';
    const TYPE_MESSAGE = 'Message';
    const TYPE_RESOURCE_CREATED = 'ResourceCreated';
    const TYPE_RESOURCE_UPDATED = 'ResourceUpdated';
    const TYPE_RESOURCE_DELETED = 'ResourceDeleted';

    public function fieldDefinitions()
    {
        return [
            'projectKey' => [static::TYPE => 'string'],
            static::NOTIFICATION_TYPE => [static::TYPE => 'string'],
            'resource' => [static::TYPE => Reference::class],
        ];
    }

    protected static function destinationType($typeId)
    {
        $types = [
            static::TYPE_MESSAGE => MessageDelivery::class,
            static::TYPE_RESOURCE_CREATED => ResourceCreatedDelivery::class,
            static::TYPE_RESOURCE_UPDATED => ResourceUpdatedDelivery::class,
            static::TYPE_RESOURCE_DELETED => ResourceDeletedDelivery::class,
        ];
        return isset($types[$typeId]) ? $types[$typeId] : Delivery::class;
    }

    public static function fromArray(array $data, $context = null)
    {
        if (get_called_class() == Delivery::class &&
            isset($data[static::NOTIFICATION_TYPE])
        ) {
            $className = static::destinationType($data[static::NOTIFICATION_TYPE]);
            if (class_exists($className)) {
                return new $className($data, $context);
            }
        }
        return new static($data, $context);
    }
}
