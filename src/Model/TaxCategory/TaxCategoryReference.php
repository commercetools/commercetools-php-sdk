<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Commercetools\Core\Model\TaxCategory;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\TaxCategory
 * @apidoc http://dev.sphere.io/http-api-types.html#reference
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

    public function fieldDefinitions()
    {
        $fields = parent::fieldDefinitions();
        $fields[static::OBJ] = [static::TYPE => '\Commercetools\Core\Model\TaxCategory\TaxCategory'];

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
