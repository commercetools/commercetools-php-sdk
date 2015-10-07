<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Payment\PaymentReference;

/**
 * @package Commercetools\Core\Request\Carts\Command
 *
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
            'payment' => [static::TYPE => '\Commercetools\Core\Model\Payment\PaymentReference'],
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
