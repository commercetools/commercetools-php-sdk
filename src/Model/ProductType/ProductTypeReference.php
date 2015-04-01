<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:37
 */

namespace Sphere\Core\Model\ProductType;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;
use Sphere\Core\Model\Common\ReferenceFromArrayTrait;

/**
 * Class ProductTypeReference
 * @package Sphere\Core\Model\ProductType
 * @method static ProductTypeReference of(string $id)
 * @method string getTypeId()
 * @method ProductTypeReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method ProductTypeReference setId(string $id = null)
 * @method array getObj()
 * @method ProductTypeReference setObj(array $obj = null)
 */
class ProductTypeReference extends Reference
{
    use ReferenceFromArrayTrait;

    const TYPE_PRODUCT_TYPE = 'product-type';

    /**
     * @param string $id
     * @param Context|callable $context
     */
    public function __construct($id, $context = null)
    {
        parent::__construct(static::TYPE_PRODUCT_TYPE, $id, $context);
    }
}
