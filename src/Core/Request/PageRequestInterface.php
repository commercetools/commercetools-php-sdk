<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

interface PageRequestInterface extends ClientRequestInterface
{
    const MAX_PAGE_SIZE = 500;

    /**
     * @param int $limit
     * @return $this
     */
    public function limit($limit);

    /**
     * @param int $offset
     * @return $this
     */
    public function offset($offset);
}
