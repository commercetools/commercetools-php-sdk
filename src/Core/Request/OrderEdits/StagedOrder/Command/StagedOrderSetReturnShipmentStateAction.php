<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderSetReturnShipmentStateAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetReturnShipmentStateAction setAction(string $action = null)
 * @method string getReturnItemId()
 * @method StagedOrderSetReturnShipmentStateAction setReturnItemId(string $returnItemId = null)
 * @method string getShipmentState()
 * @method StagedOrderSetReturnShipmentStateAction setShipmentState(string $shipmentState = null)
 */
// phpcs:ignore
class StagedOrderSetReturnShipmentStateAction extends OrderSetReturnShipmentStateAction implements StagedOrderUpdateAction
{
}
