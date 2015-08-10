<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Order
 * @apidoc http://dev.sphere.io/http-api-projects-orders.html#return-item
 * @method string getId()
 * @method ReturnItem setId(string $id = null)
 * @method int getQuantity()
 * @method ReturnItem setQuantity(int $quantity = null)
 * @method string getLineItemId()
 * @method ReturnItem setLineItemId(string $lineItemId = null)
 * @method string getComment()
 * @method ReturnItem setComment(string $comment = null)
 * @method string getShipmentState()
 * @method ReturnItem setShipmentState(string $shipmentState = null)
 * @method string getPaymentState()
 * @method ReturnItem setPaymentState(string $paymentState = null)
 * @method \DateTime getLastModifiedAt()
 * @method ReturnItem setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method \DateTime getCreatedAt()
 * @method ReturnItem setCreatedAt(\DateTime $createdAt = null)
 */
class ReturnItem extends JsonObject
{
    public function getPropertyDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'quantity' => [static::TYPE => 'int'],
            'lineItemId' => [static::TYPE => 'string'],
            'comment' => [static::TYPE => 'string'],
            'shipmentState' => [static::TYPE => 'string'],
            'paymentState' => [static::TYPE => 'string'],
            'lastModifiedAt' => [static::TYPE => '\DateTime'],
            'createdAt' => [static::TYPE => '\DateTime']
        ];
    }
}
