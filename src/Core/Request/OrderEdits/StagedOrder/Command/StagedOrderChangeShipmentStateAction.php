<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderChangeShipmentStateAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderChangeShipmentStateAction setAction(string $action = null)
 * @method string getShipmentState()
 * @method StagedOrderChangeShipmentStateAction setShipmentState(string $shipmentState = null)
 */
class StagedOrderChangeShipmentStateAction extends OrderChangeShipmentStateAction implements StagedOrderUpdateAction
{
}
