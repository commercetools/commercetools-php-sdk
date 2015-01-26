<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 11:00
 */

namespace Sphere\Core\Request;


use Sphere\Core\Error\Message;
use Sphere\Core\Error\InvalidArgumentException;
use Sphere\Core\Http\ClientRequest;
use Sphere\Core\Http\JsonEndpoint;

/**
 * Class AbstractApiRequest
 * @package Sphere\Core\Request
 */
abstract class AbstractApiRequest implements ClientRequest, ParamInterface
{
    /**
     * @var JsonEndpoint
     */
    protected $endpoint;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @param JsonEndpoint $endpoint
     */
    public function __construct(JsonEndpoint $endpoint)
    {
        $this->setEndpoint($endpoint);
    }

    /**
     * @param $endpoint
     * @return $this
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * @return JsonEndpoint
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param $key
     * @param $value
     */
    public function addParam($key, $value)
    {
        if (empty($key)) {
            throw new InvalidArgumentException(Message::NO_KEY_GIVEN);
        }
        if (!empty($value) || $value === 0) {
            $this->params[] = $key . '=' . $value;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getParamString()
    {
        $params = implode('&', $this->params);

        return $params?:'';
    }
}
