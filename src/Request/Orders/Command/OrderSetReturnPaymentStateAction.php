<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class OrderSetReturnPaymentStateAction
 * @package Sphere\Core\Request\Orders\Command
 * @link http://dev.sphere.io/http-api-projects-orders.html#set-return-payment-state
 * @method string getAction()
 * @method OrderSetReturnPaymentStateAction setAction(string $action = null)
 * @method string getReturnItemId()
 * @method OrderSetReturnPaymentStateAction setReturnItemId(string $returnItemId = null)
 * @method string getPaymentState()
 * @method OrderSetReturnPaymentStateAction setPaymentState(string $paymentState = null)
 */
class OrderSetReturnPaymentStateAction extends AbstractAction
{
    /**
     * @param string $returnItemId
     * @param string $paymentState
     * @param Context $context
     */
    public function __construct($returnItemId, $paymentState, Context $context = null)
    {
        $this->setContext($context)
            ->setAction('setReturnPaymentState')
            ->setReturnItemId($returnItemId)
            ->setPaymentState($paymentState);
    }

    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'returnItemId' => [static::TYPE => 'string'],
            'paymentState' => [static::TYPE => 'string']
        ];
    }
}
