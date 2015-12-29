<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Commercetools\Core\Model\Category;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Category
 * @apidoc  http://dev.sphere.io/http-api-types.html#reference
 * @method string getTypeId()
 * @method CategoryReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method CategoryReference setId(string $id = null)
 * @method Category getObj()
 * @method CategoryReference setObj(Category $obj = null)
 */
class CategoryReference extends Reference
{
    const TYPE_CATEGORY = 'category';

    public function fieldDefinitions()
    {
        return [
            static::TYPE_ID => [self::TYPE => 'string'],
            static::ID => [self::TYPE => 'string'],
            static::OBJ => [static::TYPE => '\Commercetools\Core\Model\Category\Category']
        ];
    }

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
