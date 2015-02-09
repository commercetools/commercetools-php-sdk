<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\Reference;
use Sphere\Core\Model\Common\ReferenceFromArrayTrait;

/**
 * Class CategoryReference
 * @package Sphere\Core\Model\Type
 * @method static ProductReference of(string $id)
 */
class ProductReference extends Reference
{
    use ReferenceFromArrayTrait;

    const TYPE_PRODUCT = 'product';

    /**
     * @param string $id
     */
    public function __construct($id)
    {
        parent::__construct(static::TYPE_PRODUCT, $id);
    }
}
