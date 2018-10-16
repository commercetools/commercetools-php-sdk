<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderSetReturnPaymentStateAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetReturnPaymentStateAction setAction(string $action = null)
 * @method string getReturnItemId()
 * @method StagedOrderSetReturnPaymentStateAction setReturnItemId(string $returnItemId = null)
 * @method string getPaymentState()
 * @method StagedOrderSetReturnPaymentStateAction setPaymentState(string $paymentState = null)
 */
class StagedOrderSetReturnPaymentStateAction extends OrderSetReturnPaymentStateAction implements StagedOrderUpdateAction
{
}
