<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Payments\Command
 * @link https://dev.commercetools.com/http-api-projects-payments.html#change-transaction-state
 * @method string getAction()
 * @method PaymentChangeTransactionStateAction setAction(string $action = null)
 * @method string getTransactionId()
 * @method PaymentChangeTransactionStateAction setTransactionId(string $transactionId = null)
 * @method string getState()
 * @method PaymentChangeTransactionStateAction setState(string $state = null)
 */
class PaymentChangeTransactionStateAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'transactionId' => [static::TYPE => 'string'],
            'state' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeTransactionState');
    }

    /**
     * @param string $transactionId
     * @param string $state
     * @param Context|callable $context
     * @return PaymentAddTransactionAction
     */
    public static function ofTransactionIdAndState($transactionId, $state, $context = null)
    {
        return static::of($context)->setTransactionId($transactionId)->setState($state);
    }
}
