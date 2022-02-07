<?php

namespace Commercetools\Core\Model\Store;

use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\ProductSelection\ProductSelectionReference;

/**
 * @package Commercetools\Core\Model\Store
 *
 * @method ProductSelectionReference getProductSelection()
 * @method ProductSelectionSetting setProductSelection(ProductSelectionReference $productSelection = null)
 * @method bool getActive()
 * @method ProductSelectionSetting setActive(bool $active = null)
 */
class ProductSelectionSetting extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'productSelection' => [static::TYPE => ProductSelectionReference::class],
            'active' => [static::TYPE => 'bool'],
        ];
    }
}
