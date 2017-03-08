<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://dev.commercetools.com/http-api-projects-productDiscounts.html#productdiscountvalue
 * @method string getType()
 * @method DiscountValue setType(string $type = null)
 * @method int getPermyriad()
 * @method DiscountValue setPermyriad(int $permyriad = null)
 * @method MoneyCollection getMoney()
 * @method DiscountValue setMoney(MoneyCollection $money = null)
 */
class DiscountValue extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'permyriad' => [static::TYPE => 'int'],
            'money' => [static::TYPE => MoneyCollection::class]
        ];
    }
}
