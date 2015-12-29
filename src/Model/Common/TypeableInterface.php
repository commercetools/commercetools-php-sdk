<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

interface TypeableInterface
{
    public static function ofType($type, $context = null);

    public static function ofTypeAndData($type, array $data, $context = null);
}
