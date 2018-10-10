<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Orders\Command\OrderAddItemShippingAddressAction;
use Commercetools\Core\Model\Common\Address;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderAddItemShippingAddressAction setAction(string $action = null)
 * @method Address getAddress()
 * @method StagedOrderAddItemShippingAddressAction setAddress(Address $address = null)
 */
class StagedOrderAddItemShippingAddressAction extends OrderAddItemShippingAddressAction implements StagedOrderUpdateAction
{

}
