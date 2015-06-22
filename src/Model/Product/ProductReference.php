<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;

/**
 * Class ProductReference
 * @package Sphere\Core\Model\Product
 * @link http://dev.sphere.io/http-api-types.html#reference
 * @method string getTypeId()
 * @method ProductReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method ProductReference setId(string $id = null)
 * @method Product getObj()
 * @method ProductReference setObj(Product $obj = null)
 */
class ProductReference extends Reference
{
    const TYPE_PRODUCT = 'product';

    public function getFields()
    {
        $fields = parent::getFields();
        $fields[static::OBJ] = [static::TYPE => '\Sphere\Core\Model\Product\Product'];

        return $fields;
    }

    /**
     * @param $id
     * @param Context|callable $context
     * @return ProductReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_PRODUCT, $id, $context);
    }
}
