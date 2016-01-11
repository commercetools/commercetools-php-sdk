<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Product
 * @apidoc http://dev.sphere.io/http-api-types.html#reference
 * @method string getTypeId()
 * @method ProductReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method ProductReference setId(string $id = null)
 * @method Product getObj()
 * @method ProductReference setObj(Product $obj = null)
 * @method string getKey()
 * @method ProductReference setKey(string $key = null)
 */
class ProductReference extends Reference
{
    const TYPE_PRODUCT = 'product';

    public function fieldDefinitions()
    {
        $fields = parent::fieldDefinitions();
        $fields[static::OBJ] = [static::TYPE => '\Commercetools\Core\Model\Product\Product'];

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
