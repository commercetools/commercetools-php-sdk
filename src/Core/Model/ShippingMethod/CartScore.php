<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

use Commercetools\Core\Model\Common\Money;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @link https://dev.commercetools.com/http-api-projects-shippingMethods.html#cartscore-with-fixed-price
 * @method string getType()
 * @method CartScore setType(string $type = null)
 * @method string getScore()
 * @method CartScore setScore(string $score = null)
 * @method Money getPrice()
 * @method CartScore setPrice(Money $price = null)
 * @method PriceFunction getPriceFunction()
 * @method CartScore setPriceFunction(PriceFunction $priceFunction = null)
 * @method bool getIsMatching()
 * @method CartScore setIsMatching(bool $isMatching = null)
 */
class CartScore extends ShippingRatePriceTier
{
    const INPUT_TYPE = 'CartScore';

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'score' => [static::TYPE => 'string'],
            'price' => [static::TYPE => Money::class],
            'priceFunction' => [static::TYPE => PriceFunction::class],
            'isMatching' => [static::TYPE => 'bool']
        ];
    }
}
