<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:25
 */

namespace Sphere\Core\Http;


class JsonEndpoint
{
    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @param $endpoint
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
