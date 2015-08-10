<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CartDiscount;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\CartDiscount
 * @apidoc http://dev.sphere.io/http-api-projects-cartDiscounts.html#cart-discount-target
 * @method string getType()
 * @method CartDiscountTarget setType(string $type = null)
 * @method string getPredicate()
 * @method CartDiscountTarget setPredicate(string $predicate = null)
 */
class CartDiscountTarget extends JsonObject
{
    const TYPE_LINE_ITEMS = 'lineItems';

    public function getPropertyDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'predicate' => [static::TYPE => 'string'],
        ];
    }
}
