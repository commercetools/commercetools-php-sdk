<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model;

interface MapperInterface
{
    /**
     * @param array $data
     * @return mixed Class instance or null
     */
    public function map(array $data);
}
