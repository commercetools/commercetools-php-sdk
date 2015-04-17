<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 11:00
 */

namespace Sphere\Core\Request;


use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Client\JsonEndpoint;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\ContextAwareInterface;
use Sphere\Core\Model\Common\ContextTrait;
use Sphere\Core\Model\Common\JsonDeserializeInterface;
use Sphere\Core\Model\Common\OfTrait;
use Sphere\Core\Request\Query\MultiParameter;
use Sphere\Core\Request\Query\Parameter;
use Sphere\Core\Request\Query\ParameterInterface;
use Sphere\Core\Response\AbstractApiResponse;

/**
 * Class AbstractApiRequest
 * @package Sphere\Core\Request
 */
abstract class AbstractApiRequest implements ClientRequestInterface, ContextAwareInterface
{
    use ContextTrait;
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

    protected $resultClass = '\Sphere\Core\Model\Common\JsonObject';

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
     * @return AbstractApiResponse
     * @internal
     */
    abstract public function buildResponse(ResponseInterface $response);

    /**
     * @param array $result
     * @param Context $context
     * @return JsonDeserializeInterface|null
     */
    public function mapResult(array $result, Context $context = null)
    {
        if (!empty($result)) {
            $object = forward_static_call_array([$this->resultClass, 'fromArray'], [$result, $context]);
            return $object;
        }
        return null;
    }
}
