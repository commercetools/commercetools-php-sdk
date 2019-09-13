<?php

namespace Commercetools\Core\Client\OAuth;

interface AnonymousIdProvider
{
    /**
     * @return string
     */
    public function getAnonymousId();
}
