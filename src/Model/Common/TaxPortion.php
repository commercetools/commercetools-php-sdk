<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


/**
 * Class TaxPortion
 * @package Sphere\Core\Model\Common
 * @method int getRate()
 * @method TaxPortion setRate(int $rate)
 * @method Money getAmount()
 * @method TaxPortion setAmount(Money $amount)
 */
class TaxPortion extends JsonObject
{
    public function getFields()
    {
        return [
            'rate' => [static::TYPE => 'int'],
            'amount' => [static::TYPE => '\Sphere\Core\Model\Common\Money'],
        ];
    }
}
