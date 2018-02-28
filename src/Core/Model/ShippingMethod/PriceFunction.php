<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Money;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @link https://dev.commercetools.com/http-api-projects-shippingMethods.html#cartscore-with-function
 * @method string getCurrencyCode()
 * @method PriceFunction setCurrencyCode(string $currencyCode = null)
 * @method string getFunction()
 * @method PriceFunction setFunction(string $function = null)
 */
class PriceFunction extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'currencyCode' => [static::TYPE => 'string'],
            'function' => [static::TYPE => 'string'],
        ];
    }
}
