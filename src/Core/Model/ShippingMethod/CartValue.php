<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

use Commercetools\Core\Model\Common\Money;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @link https://dev.commercetools.com/http-api-projects-shippingMethods.html#cartvalue
 * @method string getType()
 * @method CartValue setType(string $type = null)
 * @method int getMinimumCentAmount()
 * @method CartValue setMinimumCentAmount(int $minimumCentAmount = null)
 * @method Money getPrice()
 * @method CartValue setPrice(Money $price = null)
 * @method bool getIsMatching()
 * @method CartValue setIsMatching(bool $isMatching = null)
 */
class CartValue extends ShippingRatePriceTier
{
    const INPUT_TYPE = 'CartValue';

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'minimumCentAmount' => [static::TYPE => 'int'],
            'price' => [static::TYPE => Money::class],
            'isMatching' => [static::TYPE => 'bool']
        ];
    }
}
