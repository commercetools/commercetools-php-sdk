<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:37
 */

namespace Sphere\Core\Model\ProductType;

use Sphere\Core\Model\Type\Reference;

/**
 * Class ProductTypeReference
 * @package Sphere\Core\Model\Type
 * @method static ProductTypeReference of(string $id)
 */
class ProductTypeReference extends Reference
{
    const TYPE_PRODUCT_TYPE = 'product-type';

    /**
     * @param string $id
     */
    public function __construct($id)
    {
        parent::__construct(static::TYPE_PRODUCT_TYPE, $id);
    }
}
