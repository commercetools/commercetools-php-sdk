<?php

namespace Commercetools\Core\Model\ProductSelection;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\ProductSelection
 * @link https://docs.commercetools.com/api/projects/product-selections#assignedproductselection
 * @method ProductSelectionReference getProductSelection()
 * @method AssignedProductSelection setProductSelection(ProductSelectionReference $productSelection = null)
 */
class AssignedProductSelection extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'productSelection' => [static::TYPE => ProductSelectionReference::class],
        ];
    }
}
