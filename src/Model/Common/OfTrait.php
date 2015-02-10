<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 28.01.15, 14:32
 */

namespace Sphere\Core\Model\Common;


trait OfTrait
{
    /**
     * @return $this
     * @internal
     */
    public static function of()
    {
        $reflectClass = new \ReflectionClass(get_called_class());
        return $reflectClass->newInstanceArgs(func_get_args());
    }
}
