<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

interface WithTotalRequestInterface extends ClientRequestInterface
{
    /**
     * @param bool $withTotal
     * @return $this
     */
    public function withTotal($withTotal);
}
