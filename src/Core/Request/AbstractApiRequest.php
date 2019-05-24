<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 26.01.15, 11:00
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\JsonObjectMapper;
use Commercetools\Core\Model\MapperInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client;
use Commercetools\Core\Client\JsonEndpoint;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\ContextAwareInterface;
use Commercetools\Core\Model\Common\ContextTrait;
use Commercetools\Core\Model\Common\JsonDeserializeInterface;
use Commercetools\Core\Request\Query\MultiParameter;
use Commercetools\Core\Request\Query\Parameter;
use Commercetools\Core\Request\Query\ParameterInterface;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request
 */
abstract class AbstractApiRequest implements ClientRequestInterface, ContextAwareInterface
{
    use ContextTrait;

    /**
     * @var JsonEndpoint
     */
    protected $endpoint;

    /**
     * @var array
     */
    protected $params = [];

    protected $identifier;

    protected $resultClass = JsonObject::class;

    /**
     * @param JsonEndpoint $endpoint
     * @param Context $context
     */
    public function __construct(JsonEndpoint $endpoint, Context $context = null)
    {
        $this->setContext($context);
        $this->setEndpoint($endpoint);
    }

    /**
     * @return int
     */
    public function getParamCount()
    {
        return count($this->params);
    }

    /**
     * @return string
     * @internal
     */
    public function getResultClass()
    {
        return $this->resultClass;
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
     * @param $key
     * @param $value
     * @param bool $replace
     * @return $this
     */
    public function addParam($key, $value = null, $replace = true)
    {
        if ($replace) {
            $param = new Parameter($key, $value);
        } else {
            $param = new MultiParameter($key, $value);
        }

        return $this->addParamObject($param);
    }

    /**
     * @param ParameterInterface $param
     * @return $this
     */
    public function addParamObject(ParameterInterface $param)
    {
        $this->params[$param->getId()] = $param;

        return $this;
    }

    protected function convertToString($params)
    {
        $params = array_map(
            function ($param) {
                return (string)$param;
            },
            $params
        );
        ksort($params);
        $params = implode('&', $params);

        return $params;
    }
    /**
     * @return string
     * @internal
     */
    protected function getParamString()
    {
        $params = $this->convertToString($this->params);

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
     * @param ResponseInterface $response
     * @return ApiResponseInterface
     * @internal
     */
    abstract public function buildResponse(ResponseInterface $response);

    /**
     * @return RequestInterface
     * @internal
     */
    abstract public function httpRequest();


    /**
     * @param array $result
     * @param Context $context
     * @return JsonDeserializeInterface|null
     * @internal
     * @deprecated Use map() instead
     */
    public function mapResult(array $result, Context $context = null)
    {
        return $this->map($result, $context);
    }

    /**
     * @param ApiResponseInterface $response
     * @return JsonDeserializeInterface|null
     * @deprecated Use mapFromResponse() instead
     */
    public function mapResponse(ApiResponseInterface $response)
    {
        return $this->mapFromResponse($response);
    }

    /**
     * @inheritdoc
     */
    public function mapFromResponse($response, MapperInterface $mapper = null)
    {
        if ($response instanceof ResponseInterface) {
            $response = $this->buildResponse($response);
        }
        if ($response->isError()) {
            return null;
        }
        $result = $response->toArray();
        if ($response instanceof ContextAwareInterface) {
            return $this->map($result, $response->getContext(), $mapper);
        }

        return $this->map($result, $this->getContext(), $mapper);
    }

    public function map(array $data, Context $context = null, MapperInterface $mapper = null)
    {
        if (!empty($data)) {
            if (is_null($mapper)) {
                $mapper = JsonObjectMapper::of($context);
            }
            return $mapper->map($data, $this->resultClass);
        }

        return null;
    }

    /**
     * @param Client $client
     * @param array $headers
     * @return ApiResponseInterface
     * @throws \Commercetools\Core\Error\ApiException
     */
    public function executeWithClient(Client $client, array $headers = null)
    {
        return $client->execute($this, $headers);
    }
}
