<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\ProductDiscount;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;
use Sphere\Core\Model\Common\ReferenceFromArrayTrait;

/**
 * Class ProductDiscountReference
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
    use ReferenceFromArrayTrait;

    const TYPE_PRODUCT_DISCOUNT = 'product-discount';

    public function getFields()
    {
        return [
            'typeId' => [self::TYPE => 'string'],
            'id' => [self::TYPE => 'string'],
            'obj' => [static::TYPE => '\Sphere\Core\Model\ProductDiscount\ProductDiscount']
        ];
    }

    /**
     * @param string $id
     * @param Context|callable $context
     */
    public function __construct($id, $context = null)
    {
        parent::__construct(static::TYPE_PRODUCT_DISCOUNT, $id, $context);
    }
}
