<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Client\Adapter;

interface ConfigAware
{
    /**
     * @param string $option
     * @return mixed
     */
    public function getConfig($option);
}
