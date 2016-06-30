<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Customer;

use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Customer
 * @link https://dev.commercetools.com/http-api-projects-customers.html#customersigninresult
 * @method Customer getCustomer()
 * @method CustomerSigninResult setCustomer(Customer $customer = null)
 * @method Cart getCart()
 * @method CustomerSigninResult setCart(Cart $cart = null)
 */
class CustomerSigninResult extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'customer' => [static::TYPE => '\Commercetools\Core\Model\Customer\Customer'],
            'cart' => [static::TYPE => '\Commercetools\Core\Model\Cart\Cart']
        ];
    }
}
