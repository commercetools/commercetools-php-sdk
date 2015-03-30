<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\JsonObject;

/**
 * Class ReturnItem
 * @package Sphere\Core\Model\Order
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
    public function getFields()
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
