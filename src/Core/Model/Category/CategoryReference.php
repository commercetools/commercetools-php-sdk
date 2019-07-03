<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Commercetools\Core\Model\Category;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Category
 * @ramlTestIgnoreFields('key')
 * @link https://docs.commercetools.com/http-api-types.html#reference-types
 * @link https://docs.commercetools.com/http-api-projects-categories.html#category
 * @method string getTypeId()
 * @method CategoryReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method CategoryReference setId(string $id = null)
 * @method Category getObj()
 * @method CategoryReference setObj(Category $obj = null)
 * @method string getKey()
 * @method CategoryReference setKey(string $key = null)
 */
class CategoryReference extends Reference
{
    const TYPE_CATEGORY = 'category';
    const TYPE_CLASS = Category::class;

    /**
     * @param $id
     * @param Context|callable $context
     * @return CategoryReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_CATEGORY, $id, $context);
    }
}
