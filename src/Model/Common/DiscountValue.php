<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


/**
 * Class DiscountValue
 * @package Sphere\Core\Model\Common
 * @link http://dev.sphere.io/http-api-projects-productDiscounts.html#product-discount-value
 * @method string getType()
 * @method DiscountValue setType(string $type = null)
 * @method int getPermyriad()
 * @method DiscountValue setPermyriad(int $permyriad = null)
 * @method MoneyCollection getMoney()
 * @method DiscountValue setMoney(MoneyCollection $money = null)
 */
class DiscountValue extends JsonObject
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
