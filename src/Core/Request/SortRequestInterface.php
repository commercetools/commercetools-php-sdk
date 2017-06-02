<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

interface SortRequestInterface extends ClientRequestInterface
{
    /**
     * @param $sort
     * @return $this
     */
    public function sort($sort);
}
