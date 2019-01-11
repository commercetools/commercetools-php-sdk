<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Carts\Command\CartSetShippingAddressAction;
use Commercetools\Core\Model\Common\Address;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetShippingAddressAction setAction(string $action = null)
 * @method Address getAddress()
 * @method StagedOrderSetShippingAddressAction setAddress(Address $address = null)
 */
class StagedOrderSetShippingAddressAction extends CartSetShippingAddressAction implements StagedOrderUpdateAction
{
}
