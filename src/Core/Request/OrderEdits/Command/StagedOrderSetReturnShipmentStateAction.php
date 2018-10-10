<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Orders\Command\OrderSetReturnShipmentStateAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderSetReturnShipmentStateAction setAction(string $action = null)
 * @method string getReturnItemId()
 * @method StagedOrderSetReturnShipmentStateAction setReturnItemId(string $returnItemId = null)
 * @method string getShipmentState()
 * @method StagedOrderSetReturnShipmentStateAction setShipmentState(string $shipmentState = null)
 */
class StagedOrderSetReturnShipmentStateAction extends OrderSetReturnShipmentStateAction implements StagedOrderUpdateAction
{
}
