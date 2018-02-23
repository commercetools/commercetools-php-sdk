<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Commercetools\Core\Model\TaxCategory;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\TaxCategory
 * @link https://docs.commercetools.com/http-api-types.html#reference-types
 * @link https://docs.commercetools.com/http-api-projects-taxCategories.html#taxcategory
 * @method string getTypeId()
 * @method TaxCategoryReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method TaxCategoryReference setId(string $id = null)
 * @method TaxCategory getObj()
 * @method TaxCategoryReference setObj(TaxCategory $obj = null)
 * @method string getKey()
 * @method TaxCategoryReference setKey(string $key = null)
 */
class TaxCategoryReference extends Reference
{
    const TYPE_TAX_CATEGORY = 'tax-category';
    const TYPE_CLASS = TaxCategory::class;

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
