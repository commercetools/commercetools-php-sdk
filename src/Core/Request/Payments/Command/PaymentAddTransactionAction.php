<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Payment\Transaction;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Payments\Command
 * @link https://dev.commercetools.com/http-api-projects-payments.html#add-transaction
 * @method string getAction()
 * @method PaymentAddTransactionAction setAction(string $action = null)
 * @method Transaction getTransaction()
 * @method PaymentAddTransactionAction setTransaction(Transaction $transaction = null)
 */
class PaymentAddTransactionAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'transaction' => [static::TYPE => Transaction::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addTransaction');
    }

    /**
     * @param Transaction $transaction
     * @param Context|callable $context
     * @return PaymentAddTransactionAction
     */
    public static function ofTransaction(Transaction $transaction, $context = null)
    {
        return static::of($context)->setTransaction($transaction);
    }
}
