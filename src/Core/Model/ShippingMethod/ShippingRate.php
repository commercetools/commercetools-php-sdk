<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Money;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#shippingrate
 * @method Money getPrice()
 * @method ShippingRate setPrice(Money $price = null)
 * @method Money getFreeAbove()
 * @method ShippingRate setFreeAbove(Money $freeAbove = null)
 * @method bool getIsMatching()
 * @method ShippingRate setIsMatching(bool $isMatching = null)
 */
class ShippingRate extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'price' => [static::TYPE => Money::class],
            'freeAbove' => [static::TYPE => Money::class],
            'isMatching' => [static::TYPE => 'bool']
        ];
    }
}
