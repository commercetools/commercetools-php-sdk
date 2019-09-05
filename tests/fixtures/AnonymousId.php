<?php
/**
 *
 */

namespace Commercetools\Core\Fixtures;

use Commercetools\Core\Client\OAuth\AnonymousIdProvider;

class AnonymousId implements AnonymousIdProvider
{
    private $anonymousId;

    public function __construct($anonymousId)
    {
        $this->anonymousId = $anonymousId;
    }

    public function setAnonymousId($anonymousId)
    {
        $this->anonymousId = $anonymousId;
    }

    /**
     * @return string
     */
    public function getAnonymousId()
    {
        return $this->anonymousId;
    }
}
