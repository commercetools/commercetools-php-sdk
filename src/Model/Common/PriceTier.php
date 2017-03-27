<?php

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
     * @param int $quantity
     * @param Money $money
     * @param Context|callable $context
     * @return PriceTier
     */
    public static function ofQuantityAndMoney($quantity, Money $money, $context = null)
    {
        return static::of($context)->setValue($money)->setMinimumQuantity($quantity);
    }
}
