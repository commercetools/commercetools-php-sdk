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
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setReturnPaymentState');
    }

    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'returnItemId' => [static::TYPE => 'string'],
            'paymentState' => [static::TYPE => 'string']
        ];
    }

    /**
     * @param string $returnItemId
     * @param string $paymentState
     * @param Context|callable $context
     * @return OrderSetReturnPaymentStateAction
     */
    public static function ofReturnItemIdAndPaymentState($returnItemId, $paymentState, $context = null)
    {
        return static::of($context)->setReturnItemId($returnItemId)->setPaymentState($paymentState);
    }
}
