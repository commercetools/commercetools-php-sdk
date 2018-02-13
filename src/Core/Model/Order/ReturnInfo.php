<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://docs.commercetools.com/http-api-projects-orders.html#returninfo
 * @method ReturnItemCollection getItems()
 * @method ReturnInfo setItems(ReturnItemCollection $items = null)
 * @method string getReturnTrackingId()
 * @method ReturnInfo setReturnTrackingId(string $returnTrackingId = null)
 * @method DateTimeDecorator getReturnDate()
 * @method ReturnInfo setReturnDate(DateTime $returnDate = null)
 */
class ReturnInfo extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'items' => [static::TYPE => ReturnItemCollection::class],
            'returnTrackingId' => [static::TYPE => 'string'],
            'returnDate' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ]
        ];
    }
}
