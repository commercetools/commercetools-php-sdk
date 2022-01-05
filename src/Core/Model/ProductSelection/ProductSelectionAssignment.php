<?php

namespace Commercetools\Core\Model\ProductSelection;

use Commercetools\Core\Model\Common\CreatedBy;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\LastModifiedBy;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\ReferenceCollection;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Product\ProductReference;
use DateTime;

/**
 * @package Commercetools\Core\Model\ProductSelection
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
