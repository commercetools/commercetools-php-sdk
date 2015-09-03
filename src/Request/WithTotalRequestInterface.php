<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;


interface WithTotalRequestInterface
{
    /**
     * @param bool $withTotal
     * @return $this
     */
    public function withTotal($withTotal);
}
