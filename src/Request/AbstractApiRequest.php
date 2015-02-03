<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 11:00
 */

namespace Sphere\Core\Request;


use Sphere\Core\Error\Message;
use Sphere\Core\Error\InvalidArgumentException;
use Sphere\Core\Http\ClientRequestInterface;
use Sphere\Core\Http\JsonEndpoint;
use Sphere\Core\Model\OfTrait;
use Sphere\Core\Response\AbstractApiResponse;

/**
 * Class AbstractApiRequest
 * @package Sphere\Core\Request
 */
abstract class AbstractApiRequest implements ClientRequestInterface
{
    use OfTrait;

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
     * @internal
     */
    protected function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * @return JsonEndpoint
     * @internal
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
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
     * @internal
     */
    protected function getParamString()
    {
        $params = implode('&', $this->params);

        return (!empty($params) ? '?' . $params : '');
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . $this->getParamString();
    }

    /**
     * @param $response
     * @return AbstractApiResponse
     * @internal
     */
    abstract public function buildResponse($response);
}
