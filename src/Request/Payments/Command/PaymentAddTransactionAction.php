<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Payment\Transaction;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Customer\CustomerReference;
use Commercetools\Core\Model\State\StateReference;

/**
 * @package Commercetools\Core\Request\Payments\Command
 *
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
            'transaction' => [static::TYPE => '\Commercetools\Core\Model\Payment\Transaction'],
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
