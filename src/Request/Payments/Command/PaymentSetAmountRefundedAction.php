<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\Money;

/**
 * @package Commercetools\Core\Request\Payments\Commands
 *
 * @method string getAction()
 * @method PaymentSetAmountRefundedAction setAction(string $action = null)
 * @method Money getAmount()
 * @method PaymentSetAmountRefundedAction setAmount(Money $amount = null)
 */
class PaymentSetAmountRefundedAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'amount' => [static::TYPE => '\Commercetools\Core\Model\Common\Money'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setAmountRefunded');
    }
}
