<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderAddPaymentAction;
use Commercetools\Core\Model\Payment\PaymentReference;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderAddPaymentAction setAction(string $action = null)
 * @method PaymentReference getPayment()
 * @method StagedOrderAddPaymentAction setPayment(PaymentReference $payment = null)
 */
class StagedOrderAddPaymentAction extends OrderAddPaymentAction implements StagedOrderUpdateAction
{
}
