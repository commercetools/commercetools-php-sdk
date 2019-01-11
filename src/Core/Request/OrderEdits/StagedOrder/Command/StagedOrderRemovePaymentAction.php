<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderRemovePaymentAction;
use Commercetools\Core\Model\Payment\PaymentReference;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderRemovePaymentAction setAction(string $action = null)
 * @method PaymentReference getPayment()
 * @method StagedOrderRemovePaymentAction setPayment(PaymentReference $payment = null)
 */
class StagedOrderRemovePaymentAction extends OrderRemovePaymentAction implements StagedOrderUpdateAction
{
}
