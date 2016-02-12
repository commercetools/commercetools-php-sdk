<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 * @link https://dev.commercetools.com/http-api-projects-orders.html#change-payment-state
 * @method string getAction()
 * @method OrderChangePaymentStateAction setAction(string $action = null)
 * @method string getPaymentState()
 * @method OrderChangePaymentStateAction setPaymentState(string $paymentState = null)
 */
class OrderChangePaymentStateAction extends AbstractAction
{
    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changePaymentState');
    }

    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'paymentState' => [static::TYPE => 'string']
        ];
    }

    /**
     * @param string $paymentState
     * @param Context|callable $context
     * @return OrderChangePaymentStateAction
     */
    public static function ofPaymentState($paymentState, $context = null)
    {
        return static::of($context)->setPaymentState($paymentState);
    }
}
