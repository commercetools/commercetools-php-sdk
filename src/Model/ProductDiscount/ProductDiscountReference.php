<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\ProductDiscount;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;

/**
 * @package Sphere\Core\Model\ProductDiscount
 * @link http://dev.sphere.io/http-api-types.html#reference
 * @method static ProductDiscountReference of(string $id)
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
        $fields[static::OBJ] = [static::TYPE => '\Sphere\Core\Model\ProductDiscount\ProductDiscount'];

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
