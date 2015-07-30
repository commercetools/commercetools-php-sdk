<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Commercetools\Core\Model\ProductDiscount;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\ProductDiscount
 * @apidoc http://dev.sphere.io/http-api-types.html#reference
 * @method string getTypeId()
 * @method ProductDiscountReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method ProductDiscountReference setId(string $id = null)
 * @method ProductDiscount getObj()
 * @method ProductDiscountReference setObj(ProductDiscount $obj = null)
 */
class ProductDiscountReference extends Reference
{
    const TYPE_PRODUCT_DISCOUNT = 'product-discount';

    public function getFields()
    {
        $fields = parent::getFields();
        $fields[static::OBJ] = [static::TYPE => '\Commercetools\Core\Model\ProductDiscount\ProductDiscount'];

        return $fields;
    }

    /**
     * @param $id
     * @param Context|callable $context
     * @return ProductDiscountReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_PRODUCT_DISCOUNT, $id, $context);
    }
}
