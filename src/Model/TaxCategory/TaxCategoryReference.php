<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\TaxCategory;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;

/**
 * Class TaxCategoryReference
 * @package Sphere\Core\Model\TaxCategory
 * @link http://dev.sphere.io/http-api-types.html#reference
 * @method string getTypeId()
 * @method TaxCategoryReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method TaxCategoryReference setId(string $id = null)
 * @method TaxCategory getObj()
 * @method TaxCategoryReference setObj(TaxCategory $obj = null)
 */
class TaxCategoryReference extends Reference
{
    const TYPE_TAX_CATEGORY = 'tax-category';

    public function getFields()
    {
        $fields = parent::getFields();
        $fields[static::OBJ] = [static::TYPE => '\Sphere\Core\Model\TaxCategory\TaxCategory'];

        return $fields;
    }

    /**
     * @param $id
     * @param Context|callable $context
     * @return TaxCategoryReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_TAX_CATEGORY, $id, $context);
    }
}
