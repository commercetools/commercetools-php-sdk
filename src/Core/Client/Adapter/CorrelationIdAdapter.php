<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Client\Adapter;

interface CorrelationIdAdapter
{
    public function enableCorrelationId($projectKey = null);
}
