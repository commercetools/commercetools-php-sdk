<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Client\Adapter;

use Commercetools\Core\Helper\CorrelationIdProvider;

interface CorrelationIdAware
{
    public function setCorrelationIdProvider(CorrelationIdProvider $provider);
}
