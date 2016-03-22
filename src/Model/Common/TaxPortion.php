<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://dev.commercetools.com/http-api-projects-carts.html#tax-portion
 * @method float getRate()
 * @method TaxPortion setRate(float $rate = null)
 * @method Money getAmount()
 * @method TaxPortion setAmount(Money $amount = null)
 */
class TaxPortion extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'rate' => [static::TYPE => 'float'],
            'amount' => [static::TYPE => '\Commercetools\Core\Model\Common\Money'],
        ];
    }
}
