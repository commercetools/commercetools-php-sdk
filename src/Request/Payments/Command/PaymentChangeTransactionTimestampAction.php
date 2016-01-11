<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\DateTimeDecorator;

/**
 * @package Commercetools\Core\Request\Payments\Command
 *
 * @method string getAction()
 * @method PaymentChangeTransactionTimestampAction setAction(string $action = null)
 * @method string getTransactionId()
 * @method PaymentChangeTransactionTimestampAction setTransactionId(string $transactionId = null)
 * @method DateTimeDecorator getTimestamp()
 * @method PaymentChangeTransactionTimestampAction setTimestamp(\DateTime $timestamp = null)
 */
class PaymentChangeTransactionTimestampAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'transactionId' => [static::TYPE => 'string'],
            'timestamp' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeTransactionTimestamp');
    }

    /**
     * @param string $transactionId
     * @param \DateTime $timestamp
     * @param Context|callable $context
     * @return PaymentAddTransactionAction
     */
    public static function ofTransactionIdAndTimestamp($transactionId, \DateTime $timestamp, $context = null)
    {
        return static::of($context)->setTransactionId($transactionId)->setTimestamp($timestamp);
    }
}
