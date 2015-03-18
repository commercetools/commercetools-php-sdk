<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Cart;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\Money;

/**
 * Class DiscountedLineItemPrice
 * @package Sphere\Core\Model\Cart
 * @method Money getValue()
 * @method DiscountedLineItemPrice setValue(Money $value = null)
 * @method DiscountedLineItemPortionCollection getIncludedDiscounts()
 * @method DiscountedLineItemPrice setIncludedDiscounts(DiscountedLineItemPortionCollection $includedDiscounts = null)
 */
class DiscountedLineItemPrice extends JsonObject
{
    public function getFields()
    {
        return [
            'value' => [static::TYPE => '\Sphere\Core\Model\Common\Money'],
            'includedDiscounts' => [static::TYPE => '\Sphere\Core\Model\Cart\DiscountedLineItemPortionCollection']
        ];
    }
}
