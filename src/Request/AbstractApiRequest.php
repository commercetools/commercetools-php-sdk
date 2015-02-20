<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 11:00
 */

namespace Sphere\Core\Request;


use Sphere\Core\Error\Message;
use Sphere\Core\Error\InvalidArgumentException;
use Sphere\Core\Request\ClientRequestInterface;
use Sphere\Core\Client\JsonEndpoint;
use Sphere\Core\Model\Common\OfTrait;
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

    protected $identifier;

    /**
     * @param JsonEndpoint $endpoint
     */
    public function __construct(JsonEndpoint $endpoint)
    {
        $this->setEndpoint($endpoint);
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        if (is_null($this->identifier)) {
            $this->identifier = uniqid();
        }

        return $this->identifier;
    }

    /**
     * @param string $identifier
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * @param JsonEndpoint $endpoint
     * @return $this
     * @internal
     */
    protected function setEndpoint(JsonEndpoint $endpoint)
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
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function addParam($key, $value)
    {
        if (empty($key)) {
            throw new InvalidArgumentException(Message::NO_KEY_GIVEN);
        }
        if (is_null($value)) {
            $paramStr = $key;
        } elseif (is_bool($value)) {
            $paramStr = $key . '=' . ($value ? 'true' : 'false');
        } else {
            $paramStr = $key . '=' . urlencode((string)$value);
        }
        $this->params[$paramStr] = [$key => $value];

        return $this;
    }

    /**
     * @return string
     * @internal
     */
    protected function getParamString()
    {
        $params = array_keys($this->params);
        sort($params);
        $params = implode('&', $params);

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

    /**
     * @param array $result
     * @return mixed
     */
    public function mapResult(array $result)
    {
        return $result;
    }
}
