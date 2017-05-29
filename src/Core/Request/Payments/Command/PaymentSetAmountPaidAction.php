<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\Money;

/**
 * @package Commercetools\Core\Request\Payments\Command
 * @link https://dev.commercetools.com/http-api-projects-payments.html#set-amountpaid
 * @method string getAction()
 * @method PaymentSetAmountPaidAction setAction(string $action = null)
 * @method Money getAmount()
 * @method PaymentSetAmountPaidAction setAmount(Money $amount = null)
 */
class PaymentSetAmountPaidAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'amount' => [static::TYPE => Money::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setAmountPaid');
    }
}
