<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use DateTime;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://docs.commercetools.com/http-api-projects-orders.html#delivery
 * @method string getId()
 * @method Delivery setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Delivery setCreatedAt(DateTime $createdAt = null)
 * @method DeliveryItemCollection getItems()
 * @method Delivery setItems(DeliveryItemCollection $items = null)
 * @method ParcelCollection getParcels()
 * @method Delivery setParcels(ParcelCollection $parcels = null)
 * @method Address getAddress()
 * @method Delivery setAddress(Address $address = null)
 * @method CustomFieldObject getCustom()
 * @method Delivery setCustom(CustomFieldObject $custom = null)
 */
class Delivery extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'items' => [static::TYPE => DeliveryItemCollection::class],
            'parcels' => [static::TYPE => ParcelCollection::class],
            'address' => [static::TYPE => Address::class, static::OPTIONAL => true],
            'custom' => [static::TYPE => CustomFieldObject::class, static::OPTIONAL => true],
        ];
    }
}
