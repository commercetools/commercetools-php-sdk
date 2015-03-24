<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class OrderChangePaymentStateAction
 * @package Sphere\Core\Request\Orders\Command
 * @method string getAction()
 * @method OrderChangePaymentStateAction setAction(string $action = null)
 * @method string getPaymentState()
 * @method OrderChangePaymentStateAction setPaymentState(string $paymentState = null)
 */
class OrderChangePaymentStateAction extends AbstractAction
{
    /**
     * @param array $paymentState
     * @param Context $context
     */
    public function __construct($paymentState, Context $context = null)
    {
        $this->setContext($context)
            ->setAction('changePaymentState')
            ->setPaymentState($paymentState);
    }

    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'paymentState' => [static::TYPE => 'string']
        ];
    }
}
