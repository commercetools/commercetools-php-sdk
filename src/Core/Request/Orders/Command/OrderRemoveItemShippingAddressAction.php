<?php
/**
 *
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Request\Carts\Command\CartRemoveItemShippingAddressAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 * @link https://docs.commercetools.com/http-api-projects-orders.html#remove-itemshippingaddress
 * @method string getAction()
 * @method OrderRemoveItemShippingAddressAction setAction(string $action = null)
 * @method string getAddressKey()
 * @method OrderRemoveItemShippingAddressAction setAddressKey(string $addressKey = null)
 */
class OrderRemoveItemShippingAddressAction extends CartRemoveItemShippingAddressAction
{
}
