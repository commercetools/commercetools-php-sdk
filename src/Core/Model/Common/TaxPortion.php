<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://docs.commercetools.com/http-api-projects-carts.html#taxportion
 * @method float getRate()
 * @method TaxPortion setRate(float $rate = null)
 * @method Money getAmount()
 * @method TaxPortion setAmount(Money $amount = null)
 * @method string getName()
 * @method TaxPortion setName(string $name = null)
 */
class TaxPortion extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'name' => [static::TYPE => 'string', static::OPTIONAL => true],
            'rate' => [static::TYPE => 'float'],
            'amount' => [static::TYPE => Money::class],
        ];
    }
}
