<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;


interface QueryRequestInterface extends ClientRequestInterface
{
    /**
     * @param string $where
     * @return $this
     */
    public function where($where);
}
