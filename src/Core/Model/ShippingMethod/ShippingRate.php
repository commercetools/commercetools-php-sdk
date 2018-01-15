<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

use Commercetools\Core\Model\Common\Money;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @link https://dev.commercetools.com/http-api-projects-shippingMethods.html#shippingrate
 * @method Money getPrice()
 * @method ShippingRate setPrice(Money $price = null)
 * @method Money getFreeAbove()
 * @method ShippingRate setFreeAbove(Money $freeAbove = null)
 * @method bool getIsMatching()
 * @method ShippingRate setIsMatching(bool $isMatching = null)
 */
class ShippingRate extends ShippingRateDraft
{
    public function fieldDefinitions()
    {
        $fields = parent::fieldDefinitions();
        $fields['isMatching'] = [static::TYPE => 'bool'];
        return $fields;
    }
}
