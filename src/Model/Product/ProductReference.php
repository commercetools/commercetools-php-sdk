<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;
use Sphere\Core\Model\Common\ReferenceFromArrayTrait;

/**
 * Class ProductReference
 * @package Sphere\Core\Model\Product
 * @method static ProductReference of(string $id)
 * @method string getTypeId()
 * @method ProductReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method ProductReference setId(string $id = null)
 * @method Product getObj()
 * @method ProductReference setObj(Product $obj = null)
 */
class ProductReference extends Reference
{
    use ReferenceFromArrayTrait;

    const TYPE_PRODUCT = 'product';

    public function getFields()
    {
        return [
            'typeId' => [self::TYPE => 'string'],
            'id' => [self::TYPE => 'string'],
            'obj' => [static::TYPE => '\Sphere\Core\Model\Product\Product']
        ];
    }

    /**
     * @param string $id
     * @param Context|callable $context
     */
    public function __construct($id, $context = null)
    {
        parent::__construct(static::TYPE_PRODUCT, $id, $context);
    }
}
