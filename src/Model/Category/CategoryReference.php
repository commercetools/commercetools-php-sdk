<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\Category;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;
use Sphere\Core\Model\Common\ReferenceFromArrayTrait;

/**
 * Class CategoryReference
 * @package Sphere\Core\Model\Category
 * @method static CategoryReference of(string $id)
 * @method string getTypeId()
 * @method CategoryReference setTypeId(string $typeId)
 * @method string getId()
 * @method CategoryReference setId(string $id)
 * @method Category getObj()
 * @method CategoryReference setObj(Category $obj)
 */
class CategoryReference extends Reference
{
    use ReferenceFromArrayTrait;

    const TYPE_CATEGORY = 'category';

    public function getFields()
    {
        return [
            'typeId' => [self::TYPE => 'string'],
            'id' => [self::TYPE => 'string'],
            'obj' => [static::TYPE => '\Sphere\Core\Model\Category\Category']
        ];
    }

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(static::TYPE_CATEGORY, $id, $context);
    }
}
