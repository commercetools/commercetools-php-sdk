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
 * @link http://dev.sphere.io/http-api-projects-customers.html#customer-sign-in-result
 * @method Customer getCustomer()
 * @method CustomerSigninResult setCustomer(Customer $customer = null)
 * @method Cart getCart()
 * @method CustomerSigninResult setCart(Cart $cart = null)
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
