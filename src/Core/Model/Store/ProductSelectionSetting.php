<?php

namespace Commercetools\Core\Model\Store;

use Commercetools\Core\Model\Common\Context;
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

    /**
     * @param ProductSelectionReference $productSelection
     * @param bool $active
     * @param Context|callable $context
     * @return ProductSelectionSetting
     */
    public static function ofProductSelectionAndActive(ProductSelectionReference $productSelection, $active = null, $context = null)
    {
        return static::of($context)->setProductSelection($productSelection)->setActive($active);
    }

    /**
     * @param ProductSelectionReference $productSelection
     * @param Context|callable $context
     * @return ProductSelectionSetting
     */
    public static function ofProductSelection(ProductSelectionReference $productSelection, $context = null)
    {
        return static::of($context)->setProductSelection($productSelection);
    }
}
