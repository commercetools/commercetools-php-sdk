<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Cart;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\DiscountCode\DiscountCodeReference;

/**
 * @package Sphere\Core\Model\Cart
 * @apidoc http://dev.sphere.io/http-api-projects-carts.html#discount-code-reference
 * @method DiscountCodeReference getDiscountCode()
 * @method DiscountCodeInfo setDiscountCode(DiscountCodeReference $discountCode = null)
 * @method string getState()
 * @method DiscountCodeInfo setState(string $state = null)
 */
class DiscountCodeInfo extends JsonObject
{
    public function getFields()
    {
        return [
            'discountCode' => [static::TYPE => '\Sphere\Core\Model\DiscountCode\DiscountCodeReference'],
            'state' => [static::TYPE => 'string']
        ];
    }
}
