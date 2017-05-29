<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 09.02.15, 10:45
 */

namespace Commercetools\Core\Model\Common;

interface JsonDeserializeInterface extends ContextAwareInterface
{
    /**
     * @param array $data
     * @param Context|callable $context
     * @return mixed
     */
    public static function fromArray(array $data, $context = null);

    public function toArray();
}
