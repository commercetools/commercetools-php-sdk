<?php

namespace Commercetools\Core\Model\ProductSelection;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Product\ProductReference;

/**
 * @package Commercetools\Core\Model\ProductSelection
 * @link https://docs.commercetools.com/api/projects/product-selections#assignedproductreference
 * @method ProductReference getProduct()
 * @method AssignedProductReference setProduct(ProductReference $product = null)
 */
class AssignedProductReference extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'product' => [static::TYPE => ProductReference::class],
        ];
    }
}
