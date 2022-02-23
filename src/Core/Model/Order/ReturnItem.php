<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use DateTime;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://docs.commercetools.com/http-api-projects-orders.html#returnitem
 * @ramlTestIgnoreFields('lineItemId', 'customLineItemId')
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
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ReturnItem setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ReturnItem setCreatedAt(DateTime $createdAt = null)
 * @method string getType()
 * @method ReturnItem setType(string $type = null)
 * @method string getCustomLineItemId()
 * @method ReturnItem setCustomLineItemId(string $customLineItemId = null)
 * @method CustomFieldObject getCustom()
 * @method ReturnItem setCustom(CustomFieldObject $custom = null)
 */
class ReturnItem extends JsonObject
{
    const TYPE_LINE_ITEM = 'LineItemReturnItem';
    const TYPE_CUSTOM_LINE_ITEM = 'CustomLineItemReturnItem';

    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'quantity' => [static::TYPE => 'int'],
            'type' => [static::TYPE => 'string'],
            'lineItemId' => [static::TYPE => 'string'],
            'customLineItemId' => [static::TYPE => 'string'],
            'comment' => [static::TYPE => 'string', static::OPTIONAL => true],
            'shipmentState' => [static::TYPE => 'string'],
            'paymentState' => [static::TYPE => 'string'],
            'custom' => [static::TYPE => CustomFieldObject::class, static::OPTIONAL => true],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ]
        ];
    }
}
