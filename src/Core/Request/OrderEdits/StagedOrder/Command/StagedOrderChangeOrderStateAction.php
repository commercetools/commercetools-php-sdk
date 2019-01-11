<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderChangeOrderStateAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderChangeOrderStateAction setAction(string $action = null)
 * @method string getOrderState()
 * @method StagedOrderChangeOrderStateAction setOrderState(string $orderState = null)
 */
class StagedOrderChangeOrderStateAction extends OrderChangeOrderStateAction implements StagedOrderUpdateAction
{
}
