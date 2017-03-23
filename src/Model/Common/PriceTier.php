<?php
/**
 * Created by PhpStorm.
 * User: ibrahimselim
 * Date: 23/03/17
 * Time: 14:21
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 *
 * @method int getMinimumQuantity()
 * @method PriceTier setMinimumQuantity(int $minimumQuantity = null)
 * @method Money getValue()
 * @method PriceTier setValue(Money $value = null)
 */
class PriceTier extends JsonObject
{
    const MINIMUMQUANTITY = 'minimumQuantity';
    const VALUE = 'value';

    public function fieldDefinitions()
    {
        return [
            static::MINIMUMQUANTITY => [static::TYPE => 'int'],
            static::VALUE => [self::TYPE => Money::class]
        ];
    }
    /**
     * @param int $minimumQuantity
     * @param Money $money
     * @param Context|callable $context
     * @return PriceTier
     */
    public static function ofMinimumQuantityAndMoney($minimumQuantity, Money $money, $context = null)
    {
        $price = static::of($context);
        $price = $price->setValue($money);
        return $price->setMinimumQuantity($minimumQuantity);
    }
}
