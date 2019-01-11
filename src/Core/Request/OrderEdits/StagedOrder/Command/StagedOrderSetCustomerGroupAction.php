<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Carts\Command\CartSetCustomerGroupAction;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetCustomerGroupAction setAction(string $action = null)
 * @method CustomerGroupReference getCustomerGroup()
 * @method StagedOrderSetCustomerGroupAction setCustomerGroup(CustomerGroupReference $customerGroup = null)
 */
class StagedOrderSetCustomerGroupAction extends CartSetCustomerGroupAction implements StagedOrderUpdateAction
{

}
