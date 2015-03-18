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
 * @method static ProductDiscountReference of(string $id)
 * @method string getTypeId()
 * @method ProductDiscountReference setTypeId(string $typeId)
 * @method string getId()
 * @method ProductDiscountReference setId(string $id)
 * @method array getObj()
 * @method ProductDiscountReference setObj(array $obj)
 */
class ProductDiscountReference extends Reference
{
    use ReferenceFromArrayTrait;

    const TYPE_PRODUCT_DISCOUNT = 'product-discount';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(static::TYPE_PRODUCT_DISCOUNT, $id, $context);
    }
}
