<?php

namespace Commercetools\Core\Model\ProductSelection;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\ProductSelection
 * @ramlTestIgnoreFields('key')
 * @method string getTypeId()
 * @method ProductSelectionReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method ProductSelectionReference setId(string $id = null)
 * @method ProductSelection getObj()
 * @method ProductSelectionReference setObj(ProductSelection $obj = null)
 * @method string getKey()
 * @method ProductSelectionReference setKey(string $key = null)
 */
class ProductSelectionReference extends Reference
{
    const TYPE_PRODUCT_SELECTION = 'product-selection';
    const TYPE_CLASS = ProductSelection::class;

    /**
     * @param $id
     * @param Context|callable $context
     * @return ProductSelectionReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_PRODUCT_SELECTION, $id, $context);
    }
}
