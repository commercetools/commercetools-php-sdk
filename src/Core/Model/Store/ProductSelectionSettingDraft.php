<?php

namespace Commercetools\Core\Model\Store;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\ProductSelection\ProductSelectionReference;

/**
 * @package Commercetools\Core\Model\Store
 *
 * @method ProductSelectionReference getProductSelection()
 * @method ProductSelectionSettingDraft setProductSelection(ProductSelectionReference $productSelection = null)
 * @method bool getActive()
 * @method ProductSelectionSettingDraft setActive(bool $active = null)
 */
class ProductSelectionSettingDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'productSelection' => [static::TYPE => ProductSelectionReference::class],
            'active' => [static::TYPE => 'bool'],
        ];
    }
}
