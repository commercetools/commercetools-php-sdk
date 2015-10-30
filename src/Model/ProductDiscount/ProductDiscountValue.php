<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductDiscount;

use Commercetools\Core\Model\Common\DiscountValue;
use Commercetools\Core\Model\Common\MoneyCollection;

/**
 * @package Commercetools\Core\Model\ProductDiscount
 * @apidoc http://dev.sphere.io/http-api-projects-productDiscounts.html#product-discount-value
 * @method string getType()
 * @method ProductDiscountValue setType(string $type = null)
 * @method int getPermyriad()
 * @method ProductDiscountValue setPermyriad(int $permyriad = null)
 * @method MoneyCollection getMoney()
 * @method ProductDiscountValue setMoney(MoneyCollection $money = null)
 */
class ProductDiscountValue extends DiscountValue
{
}
