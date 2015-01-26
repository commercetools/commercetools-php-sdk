<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 11:00
 */

namespace Sphere\Core\Request;


use Sphere\Core\Http\ClientRequest;
use Sphere\Core\Http\JsonEndpoint;

abstract class AbstractApiRequest implements ClientRequest, ParamInterface
{
    /**
     * @var JsonEndpoint
     */
    protected $endpoint;

    protected $params;

    public function __construct(JsonEndpoint $endpoint)
    {
        $this->params = [];
        $this->setEndpoint($endpoint);
    }

    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function addParam($key, $value)
    {
        if (empty($key)) {
            throw new \InvalidArgumentException('No key given');
        }
        if (!empty($value) || $value === 0) {
            $this->params[] = $key . '=' . $value;
        }
    }

    public function getParamString()
    {
        $params = implode('&', $this->params);

        return $params?:'';
    }
}
