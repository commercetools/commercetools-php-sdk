<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Request\Payments\Command
 * @link https://docs.commercetools.com/http-api-projects-payments.html#set-authorization
 * @method string getAction()
 * @method PaymentSetAuthorizationAction setAction(string $action = null)
 * @method Money getAmount()
 * @method PaymentSetAuthorizationAction setAmount(Money $amount = null)
 * @method DateTimeDecorator getUntil()
 * @method PaymentSetAuthorizationAction setUntil(DateTime $until = null)
 */
class PaymentSetAuthorizationAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'amount' => [static::TYPE => Money::class],
            'until' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
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
