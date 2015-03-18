<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\CartDiscount;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\MoneyCollection;

/**
 * Class CartDiscountValue
 * @package Sphere\Core\Model\CartDiscount
 * @method string getType()
 * @method CartDiscountValue setType(string $type = null)
 * @method int getPermyriad()
 * @method CartDiscountValue setPermyriad(int $permyriad = null)
 * @method MoneyCollection getMoney()
 * @method CartDiscountValue setMoney(MoneyCollection $money = null)
 */
class CartDiscountValue extends JsonObject
{
    public function getFields()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'permyriad' => [static::TYPE => 'int'],
            'money' => [static::TYPE => '\Sphere\Core\Model\Common\MoneyCollection']
        ];
    }
}
