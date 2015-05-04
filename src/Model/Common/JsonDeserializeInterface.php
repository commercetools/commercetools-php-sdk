<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 09.02.15, 10:45
 */

namespace Sphere\Core\Model\Common;


interface JsonDeserializeInterface extends ContextAwareInterface
{
    /**
     * @param array $data
     * @param Context|callable $context
     * @return mixed
     */
    public static function fromArray(array $data, $context = null);
}
