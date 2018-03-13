<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Payment\PaymentReference;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://docs.commercetools.com/http-api-projects-carts.html#add-payment
 * @method string getAction()
 * @method CartAddPaymentAction setAction(string $action = null)
 * @method PaymentReference getPayment()
 * @method CartAddPaymentAction setPayment(PaymentReference $payment = null)
 */
class CartAddPaymentAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'payment' => [static::TYPE => PaymentReference::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addPayment');
    }
}
