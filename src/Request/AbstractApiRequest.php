<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 11:00
 */

namespace Commercetools\Core\Request;

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

    protected $resultClass = '\Commercetools\Core\Model\Common\JsonObject';

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

    /**
     * @return string
     * @internal
     */
    protected function getParamString()
    {
        $params = array_map(
            function ($param) {
                return (string)$param;
            },
            $this->params
        );
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
     */
    public function mapResult(array $result, Context $context = null)
    {
        if (!empty($result)) {
            $object = forward_static_call_array([$this->resultClass, 'fromArray'], [$result, $context]);
            return $object;
        }
        return null;
    }

    /**
     * @param ApiResponseInterface $response
     * @return JsonDeserializeInterface|null
     */
    public function mapResponse(ApiResponseInterface $response)
    {
        if ($response->isError()) {
            return null;
        }
        $result = $response->toArray();
        if ($response instanceof ContextAwareInterface) {
            return $this->mapResult($result, $response->getContext());
        }

        return $this->mapResult($result, $this->getContext());
    }

    /**
     * @param Client $client
     * @return ApiResponseInterface
     */
    public function executeWithClient(Client $client)
    {
        return $client->execute($this);
    }
}
