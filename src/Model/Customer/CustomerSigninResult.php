<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Customer;

use Sphere\Core\Model\Cart\Cart;
use Sphere\Core\Model\Common\JsonObject;

/**
 * Class CustomerSigninResult
 * @package Sphere\Core\Model\Customer
 * @method Customer getCustomer()
 * @method CustomerSigninResult setCustomer(Customer $customer)
 * @method Cart getCart()
 * @method CustomerSigninResult setCart(Cart $cart)
 */
class CustomerSigninResult extends JsonObject
{
    public function getFields()
    {
        return [
            'customer' => [static::TYPE => '\Sphere\Core\Model\Customer\Customer'],
            'cart' => [static::TYPE => '\Sphere\Core\Model\Cart\Cart']
        ];
    }
}
