<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderChangePaymentStateAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderChangePaymentStateAction setAction(string $action = null)
 * @method string getPaymentState()
 * @method StagedOrderChangePaymentStateAction setPaymentState(string $paymentState = null)
 */
class StagedOrderChangePaymentStateAction extends OrderChangePaymentStateAction implements StagedOrderUpdateAction
{
}
