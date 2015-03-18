<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


/**
 * Class TaxPortion
 * @package Sphere\Core\Model\Common
 * @method int getRate()
 * @method TaxPortion setRate(int $rate = null)
 * @method Money getAmount()
 * @method TaxPortion setAmount(Money $amount = null)
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
