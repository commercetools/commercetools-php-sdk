<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\ProductDiscount;

use Sphere\Core\Model\Common\Reference;
use Sphere\Core\Model\Common\ReferenceFromArrayTrait;

/**
 * Class CategoryReference
 * @package Sphere\Core\Model\Type
 * @method static ProductDiscountReference of(string $id)
 */
class ProductDiscountReference extends Reference
{
    use ReferenceFromArrayTrait;

    const TYPE_PRODUCT_DISCOUNT = 'product-discount';

    /**
     * @param string $id
     */
    public function __construct($id)
    {
        parent::__construct(static::TYPE_PRODUCT_DISCOUNT, $id);
    }
}
