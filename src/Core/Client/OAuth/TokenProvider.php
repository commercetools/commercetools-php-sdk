<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Client\OAuth;

interface TokenProvider
{
    /**
     * @return Token
     */
    public function getToken();
}
