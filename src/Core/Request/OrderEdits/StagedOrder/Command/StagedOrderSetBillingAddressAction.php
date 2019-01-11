<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Carts\Command\CartSetBillingAddressAction;
use Commercetools\Core\Model\Common\Address;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetBillingAddressAction setAction(string $action = null)
 * @method Address getAddress()
 * @method StagedOrderSetBillingAddressAction setAddress(Address $address = null)
 */
class StagedOrderSetBillingAddressAction extends CartSetBillingAddressAction implements StagedOrderUpdateAction
{
}
