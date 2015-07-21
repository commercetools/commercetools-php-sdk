<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


/**
 * @package Sphere\Core\Model\Common
 * @link http://dev.sphere.io/http-api-projects-carts.html#tax-portion
 * @method float getRate()
 * @method TaxPortion setRate(float $rate = null)
 * @method Money getAmount()
 * @method TaxPortion setAmount(Money $amount = null)
 */
class TaxPortion extends JsonObject
{
    public function getFields()
    {
        return [
            'rate' => [static::TYPE => 'float'],
            'amount' => [static::TYPE => '\Sphere\Core\Model\Common\Money'],
        ];
    }
}
