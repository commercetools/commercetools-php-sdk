<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\DateTimeDecorator;

/**
 * @package Commercetools\Core\Request\Payments\Commands
 *
 * @method string getAction()
 * @method PaymentSetAuthorizationAction setAction(string $action = null)
 * @method Money getAmount()
 * @method PaymentSetAuthorizationAction setAmount(Money $amount = null)
 * @method DateTimeDecorator getUntil()
 * @method PaymentSetAuthorizationAction setUntil(\DateTime $until = null)
 */
class PaymentSetAuthorizationAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'amount' => [static::TYPE => '\Commercetools\Core\Model\Common\Money'],
            'until' => [
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
        $this->setAction('setAuthorization');
    }
}
