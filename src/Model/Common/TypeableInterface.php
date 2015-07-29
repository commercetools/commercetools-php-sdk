<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


interface TypeableInterface
{
    public static function ofType($type, $context = null);

    public static function ofTypeAndData($type, array $data, $context = null);
}
