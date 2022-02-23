<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

use Commercetools\Core\Model\Common\Money;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @link https://dev.commercetools.com/http-api-projects-shippingMethods.html#cartclassification
 * @method string getType()
 * @method CartClassification setType(string $type = null)
 * @method string getValue()
 * @method CartClassification setValue(string $value = null)
 * @method Money getPrice()
 * @method CartClassification setPrice(Money $price = null)
 * @method bool getIsMatching()
 * @method CartClassification setIsMatching(bool $isMatching = null)
 */
class CartClassification extends ShippingRatePriceTier
{
    const INPUT_TYPE = 'CartClassification';

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'value' => [static::TYPE => 'string'],
            'price' => [static::TYPE => Money::class],
            'isMatching' => [static::TYPE => 'bool', static::OPTIONAL => true]
        ];
    }
}
