<?php

namespace Commercetools\Core\Model\ProductSelection;

use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Product\ProductReference;

/**
 * @package Commercetools\Core\Model\ProductSelection
 * @link https://docs.commercetools.com/api/projects/product-selections#productselectionassignment
 * @method ProductReference getProduct()
 * @method ProductSelectionAssignment setProduct(ProductReference $product = null)
 * @method ProductSelectionReference getProductSelection()
 * @method ProductSelectionAssignment setProductSelection(ProductSelectionReference $productSelection = null)
 */
class ProductSelectionAssignment extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'product' => [static::TYPE => ProductReference::class],
            'productSelection' => [static::TYPE => ProductSelectionReference::class],
        ];
    }
}
