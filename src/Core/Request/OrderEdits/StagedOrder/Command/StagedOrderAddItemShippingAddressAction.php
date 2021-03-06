<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderAddItemShippingAddressAction;
use Commercetools\Core\Model\Common\Address;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderAddItemShippingAddressAction setAction(string $action = null)
 * @method Address getAddress()
 * @method StagedOrderAddItemShippingAddressAction setAddress(Address $address = null)
 */
// phpcs:ignore
class StagedOrderAddItemShippingAddressAction extends OrderAddItemShippingAddressAction implements StagedOrderUpdateAction
{
}
