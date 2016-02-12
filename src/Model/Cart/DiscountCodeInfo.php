<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\DiscountCode\DiscountCodeReference;

/**
 * @package Commercetools\Core\Model\Cart
 * @link http://dev.commercetools.com/http-api-projects-carts.html#discount-code-reference
 * @method DiscountCodeReference getDiscountCode()
 * @method DiscountCodeInfo setDiscountCode(DiscountCodeReference $discountCode = null)
 * @method string getState()
 * @method DiscountCodeInfo setState(string $state = null)
 */
class DiscountCodeInfo extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'discountCode' => [static::TYPE => '\Commercetools\Core\Model\DiscountCode\DiscountCodeReference'],
            'state' => [static::TYPE => 'string']
        ];
    }
}
