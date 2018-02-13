<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Helper;

interface CorrelationIdProvider
{
    /**
     * Returns a unique ID to be used for a CTP request
     * @return string
     */
    public function getCorrelationId();
}
