<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\CartDiscount;

use Sphere\Core\Model\Common\DiscountValue;
use Sphere\Core\Model\Common\MoneyCollection;

/**
 * @package Sphere\Core\Model\CartDiscount
 * @apidoc http://dev.sphere.io/http-api-projects-cartDiscounts.html#cart-discount-value
 * @method string getType()
 * @method CartDiscountValue setType(string $type = null)
 * @method int getPermyriad()
 * @method CartDiscountValue setPermyriad(int $permyriad = null)
 * @method MoneyCollection getMoney()
 * @method CartDiscountValue setMoney(MoneyCollection $money = null)
 */
class CartDiscountValue extends DiscountValue
{
}
