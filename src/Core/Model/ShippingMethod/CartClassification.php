<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

use Commercetools\Core\Model\Common\Money;

/**
 * @package Commercetools\Core\Model\Project
 * @link https://dev.commercetools.com/http-api-projects-shippingMethods.html#cartclassification
 * @method string getType()
 * @method CartClassification setType(string $type = null)
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
            'isMatching' => [static::TYPE => 'bool']
        ];
    }
}
