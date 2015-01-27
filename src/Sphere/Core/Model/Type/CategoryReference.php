<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\Type;


class CategoryReference extends Reference
{
    public static function of($id)
    {
        return new static('category', $id);
    }
}
