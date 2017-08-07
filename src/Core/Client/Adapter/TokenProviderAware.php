<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Client\Adapter;

use Commercetools\Core\Client\OAuth\TokenProvider;

interface TokenProviderAware
{
    public function setOAuthTokenProvider(TokenProvider $tokenProvider);
}
