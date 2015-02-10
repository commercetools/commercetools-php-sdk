<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 09.02.15, 10:45
 */

namespace Sphere\Core\Model\Common;


interface JsonDeserializeInterface
{
    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data);
}
