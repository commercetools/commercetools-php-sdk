<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Request\Carts\Command\CartRemovePaymentAction;
use Commercetools\Core\Model\Payment\PaymentReference;

/**
 * @package Commercetools\Core\Request\Orders\Command
 * @link https://dev.commercetools.com/http-api-projects-orders.html#remove-payment
 * @method string getAction()
 * @method OrderRemovePaymentAction setAction(string $action = null)
 * @method PaymentReference getPayment()
 * @method OrderRemovePaymentAction setPayment(PaymentReference $payment = null)
 */
class OrderRemovePaymentAction extends CartRemovePaymentAction
{
}
