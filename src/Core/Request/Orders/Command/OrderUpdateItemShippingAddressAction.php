<?php
/**
 *
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Request\Carts\Command\CartUpdateItemShippingAddressAction;
use Commercetools\Core\Model\Common\Address;

/**
 * @package Commercetools\Core\Request\Orders\Command
 * @link https://docs.commercetools.com/http-api-projects-orders.html#update-itemshippingaddress
 * @method string getAction()
 * @method OrderUpdateItemShippingAddressAction setAction(string $action = null)
 * @method Address getAddress()
 * @method OrderUpdateItemShippingAddressAction setAddress(Address $address = null)
 */
class OrderUpdateItemShippingAddressAction extends CartUpdateItemShippingAddressAction
{

}
