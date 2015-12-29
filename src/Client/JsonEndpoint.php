<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:25
 */

namespace Commercetools\Core\Client;

/**
 * @package Commercetools\Core\Http
 * @internal
 */
class JsonEndpoint
{
    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @param string $endpoint
     */
    public function __construct($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @return string
     */
    public function endpoint()
    {
        return $this->endpoint;
    }

    public function __toString()
    {
        return $this->endpoint();
    }
}
