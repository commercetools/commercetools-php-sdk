<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model;

interface MapperInterface
{
    /**
     * @param array $data
     * @param mixed $class class or object to map the data to
     * @return mixed Class instance or null
     */
    public function map(array $data, $class);
}
