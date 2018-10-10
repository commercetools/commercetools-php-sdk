<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Orders\Command\OrderSetParcelItemsAction;
use Commercetools\Core\Model\Order\DeliveryItemCollection;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderSetParcelItemsAction setAction(string $action = null)
 * @method string getParcelId()
 * @method StagedOrderSetParcelItemsAction setParcelId(string $parcelId = null)
 * @method DeliveryItemCollection getItems()
 * @method StagedOrderSetParcelItemsAction setItems(DeliveryItemCollection $items = null)
 */
class StagedOrderSetParcelItemsAction extends OrderSetParcelItemsAction implements StagedOrderUpdateAction
{

}
