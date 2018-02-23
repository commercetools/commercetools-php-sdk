<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Customer\CustomerReference;

/**
 * @package Commercetools\Core\Request\Payments\Command
 * @link https://docs.commercetools.com/http-api-projects-payments.html#set-customer
 * @method string getAction()
 * @method PaymentSetCustomerAction setAction(string $action = null)
 * @method CustomerReference getCustomer()
 * @method PaymentSetCustomerAction setCustomer(CustomerReference $customer = null)
 */
class PaymentSetCustomerAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'customer' => [static::TYPE => CustomerReference::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setCustomer');
    }
}
