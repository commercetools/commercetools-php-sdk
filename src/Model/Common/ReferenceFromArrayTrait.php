<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 09.02.15, 13:29
 */

namespace Sphere\Core\Model\Common;


/**
 * Class ReferenceFromArrayTrait
 * @package Sphere\Core\Model\Common
 */
trait ReferenceFromArrayTrait
{
    public static function fromArray(array $data)
    {
        return new static($data['id']);
    }
}
