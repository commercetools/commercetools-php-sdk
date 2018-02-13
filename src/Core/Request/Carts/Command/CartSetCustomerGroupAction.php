<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 *
 * @method string getAction()
 * @method CartSetCustomerGroupAction setAction(string $action = null)
 * @method CustomerGroupReference getCustomerGroup()
 * @method CartSetCustomerGroupAction setCustomerGroup(CustomerGroupReference $customerGroup = null)
 */
class CartSetCustomerGroupAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'customerGroup' => [static::TYPE => CustomerGroupReference::class],
        ];
    }

    /**
     * @param CustomerGroupReference $customerGroup
     * @param Context|callable $context
     * @return CartSetCustomerGroupAction
     */
    public static function ofCustomerGroup($customerGroup, $context = null)
    {
        return static::of($context)->setCustomerGroup($customerGroup);
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setCustomerGroup');
    }
}
