<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Request\Carts\Command\CartAddPaymentAction;
use Commercetools\Core\Model\Payment\PaymentReference;

/**
 * @package Commercetools\Core\Request\Orders\Command
 *
 * @method string getAction()
 * @method OrderAddPaymentAction setAction(string $action = null)
 * @method PaymentReference getPayment()
 * @method OrderAddPaymentAction setPayment(PaymentReference $payment = null)
 */
class OrderAddPaymentAction extends CartAddPaymentAction
{
}
