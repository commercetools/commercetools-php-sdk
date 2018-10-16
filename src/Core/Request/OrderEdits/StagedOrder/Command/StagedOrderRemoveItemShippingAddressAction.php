<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderRemoveItemShippingAddressAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderRemoveItemShippingAddressAction setAction(string $action = null)
 * @method string getAddressKey()
 * @method StagedOrderRemoveItemShippingAddressAction setAddressKey(string $addressKey = null)
 */
class StagedOrderRemoveItemShippingAddressAction extends OrderRemoveItemShippingAddressAction implements StagedOrderUpdateAction
{

}
