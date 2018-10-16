<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Carts\Command\CartSetCustomerIdAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetCustomerIdAction setAction(string $action = null)
 * @method string getCustomerId()
 * @method StagedOrderSetCustomerIdAction setCustomerId(string $customerId = null)
 */
class StagedOrderSetCustomerIdAction extends CartSetCustomerIdAction implements StagedOrderUpdateAction
{
}
