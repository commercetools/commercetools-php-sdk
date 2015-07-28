<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:25
 */

namespace Sphere\Core\Client;

/**
 * @package Sphere\Core\Http
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
