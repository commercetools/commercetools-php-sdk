<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\JsonObject;

/**
 * @package Sphere\Core\Model\Order
 * @apidoc http://dev.sphere.io/http-api-projects-orders.html#return-info
 * @method ReturnItemCollection getItems()
 * @method ReturnInfo setItems(ReturnItemCollection $items = null)
 * @method string getReturnTrackingId()
 * @method ReturnInfo setReturnTrackingId(string $returnTrackingId = null)
 * @method \DateTime getReturnDate()
 * @method ReturnInfo setReturnDate(\DateTime $returnDate = null)
 */
class ReturnInfo extends JsonObject
{
    public function getFields()
    {
        return [
            'items' => [static::TYPE => '\Sphere\Core\Model\Order\ReturnItemCollection'],
            'returnTrackingId' => [static::TYPE => 'string'],
            'returnDate' => [static::TYPE => '\DateTime']
        ];
    }
}
