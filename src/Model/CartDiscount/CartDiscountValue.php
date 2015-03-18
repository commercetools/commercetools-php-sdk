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
 * @method CartDiscountValue setType(string $type)
 * @method int getPermyriad()
 * @method CartDiscountValue setPermyriad(int $permyriad)
 * @method MoneyCollection getMoney()
 * @method CartDiscountValue setMoney(MoneyCollection $money)
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
