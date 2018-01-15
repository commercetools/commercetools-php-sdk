<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

/**
 * @package Commercetools\Core\Model\Project
 * @link https://dev.commercetools.com/http-api-projects-shippingMethods.html#cartscore
 * @method string getType()
 * @method CartScore setType(string $type = null)
 */
class CartScore extends ShippingRatePriceTier
{
    const INPUT_TYPE = 'CartScore';
}
