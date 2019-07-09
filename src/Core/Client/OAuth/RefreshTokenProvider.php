<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Client\OAuth;

interface RefreshTokenProvider extends TokenProvider
{
    /**
     * @return Token
     */
    public function refreshToken();
}
