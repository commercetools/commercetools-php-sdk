<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Orders\Command\OrderUpdateItemShippingAddressAction;
use Commercetools\Core\Model\Common\Address;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderUpdateItemShippingAddressAction setAction(string $action = null)
 * @method Address getAddress()
 * @method StagedOrderUpdateItemShippingAddressAction setAddress(Address $address = null)
 */
class StagedOrderUpdateItemShippingAddressAction extends OrderUpdateItemShippingAddressAction implements StagedOrderUpdateAction
{

}
