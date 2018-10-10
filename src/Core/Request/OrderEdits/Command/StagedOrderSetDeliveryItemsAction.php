<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Orders\Command\OrderSetDeliveryItemsAction;
use Commercetools\Core\Model\Order\DeliveryItemCollection;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderSetDeliveryItemsAction setAction(string $action = null)
 * @method string getDeliveryId()
 * @method StagedOrderSetDeliveryItemsAction setDeliveryId(string $deliveryId = null)
 * @method DeliveryItemCollection getItems()
 * @method StagedOrderSetDeliveryItemsAction setItems(DeliveryItemCollection $items = null)
 */
class StagedOrderSetDeliveryItemsAction extends OrderSetDeliveryItemsAction implements StagedOrderUpdateAction
{
}
