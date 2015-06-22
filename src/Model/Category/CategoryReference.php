<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\Category;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;

/**
 * Class CategoryReference
 * @package Sphere\Core\Model\Category
 * @link  http://dev.sphere.io/http-api-types.html#reference
 * @method static CategoryReference of(string $id)
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

    public function getFields()
    {
        return [
            static::TYPE_ID => [self::TYPE => 'string'],
            static::ID => [self::TYPE => 'string'],
            static::OBJ => [static::TYPE => '\Sphere\Core\Model\Category\Category']
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
