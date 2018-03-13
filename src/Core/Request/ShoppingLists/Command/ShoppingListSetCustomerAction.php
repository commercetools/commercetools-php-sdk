<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShoppingLists\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Customer\CustomerReference;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ShoppingLists\Command
 * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-customer
 * @method string getAction()
 * @method ShoppingListSetCustomerAction setAction(string $action = null)
 * @method CustomerReference getCustomer()
 * @method ShoppingListSetCustomerAction setCustomer(CustomerReference $customer = null)
 */
class ShoppingListSetCustomerAction extends AbstractAction
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

    /**
     * @param CustomerReference $customer
     * @param Context|callable $context
     * @return ShoppingListSetCustomerAction
     */
    public static function ofCustomer(CustomerReference $customer, $context = null)
    {
        return static::of($context)->setCustomer($customer);
    }
}
