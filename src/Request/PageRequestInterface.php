<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

interface PageRequestInterface extends ClientRequestInterface
{
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
