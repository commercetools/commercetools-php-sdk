<?php
/**
 *
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Request\Carts\Command\CartAddItemShippingAddressAction;
use Commercetools\Core\Model\Common\Address;

/**
 * @package Commercetools\Core\Request\Orders\Command
 * @link https://docs.commercetools.com/http-api-projects-orders.html#add-itemshippingaddress
 * @method string getAction()
 * @method OrderAddItemShippingAddressAction setAction(string $action = null)
 * @method Address getAddress()
 * @method OrderAddItemShippingAddressAction setAddress(Address $address = null)
 */
class OrderAddItemShippingAddressAction extends CartAddItemShippingAddressAction
{
}
