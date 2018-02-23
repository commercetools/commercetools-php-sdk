<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\Money;

/**
 * @package Commercetools\Core\Request\Payments\Command
 * @link https://docs.commercetools.com/http-api-projects-payments.html#change-amountplanned
 * @method string getAction()
 * @method PaymentChangeAmountPlannedAction setAction(string $action = null)
 * @method Money getAmount()
 * @method PaymentChangeAmountPlannedAction setAmount(Money $amount = null)
 */
class PaymentChangeAmountPlannedAction extends AbstractAction
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
        $this->setAction('changeAmountPlanned');
    }
}
