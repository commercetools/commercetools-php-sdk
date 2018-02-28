<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CartDiscount;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\DiscountValue;
use Commercetools\Core\Model\Common\MoneyCollection;

/**
 * @package Commercetools\Core\Model\CartDiscount
 * @ramlTestIgnoreFields('permyriad', 'money')
 * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#cartdiscountvalue
 * @deprecated use RelativeCartDiscountValue, AbsoluteCartDiscountValue or GiftLineItemCartDiscountValue instead.
 * @method string getType()
 * @method CartDiscountValue setType(string $type = null)
 * @method int getPermyriad()
 * @method CartDiscountValue setPermyriad(int $permyriad = null)
 * @method MoneyCollection getMoney()
 * @method CartDiscountValue setMoney(MoneyCollection $money = null)
 */
class CartDiscountValue extends DiscountValue
{
    const TYPE_RELATIVE = 'relative';
    const TYPE_ABSOLUTE = 'absolute';
    const TYPE_GIFT_LINE_ITEM = 'giftLineItem';

    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        if (isset($data['type'])) {
            $className = static::getClassByType($data['type']);
            if (class_exists($className)) {
                return new $className($data, $context);
            }
        }
        return new static($data, $context);
    }

    protected static function getClassByType($type)
    {
        $className = '\Commercetools\Core\Model\CartDiscount\\' . ucfirst($type) . 'CartDiscountValue';
        return $className;
    }
}
