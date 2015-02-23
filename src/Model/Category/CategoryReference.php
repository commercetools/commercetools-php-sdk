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
 * @package Sphere\Core\Model\Type
 * @method static CategoryReference of(string $id)
 */
class CategoryReference extends Reference
{
    use ReferenceFromArrayTrait;

    const TYPE_CATEGORY = 'category';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(static::TYPE_CATEGORY, $id, $context);
    }
}
