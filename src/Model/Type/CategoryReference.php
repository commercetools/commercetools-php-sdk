<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\Type;


/**
 * Class CategoryReference
 * @package Sphere\Core\Model\Type
 * @method static CategoryReference of(string $id)
 */
class CategoryReference extends Reference
{
    const TYPE_CATEGORY = 'category';

    /**
     * @param string $id
     */
    public function __construct($id)
    {
        parent::__construct(static::TYPE_CATEGORY, $id);
    }
}
