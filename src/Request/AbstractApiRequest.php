<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 11:00
 */

namespace Sphere\Core\Request;


use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Error\Message;
use Sphere\Core\Error\InvalidArgumentException;
use Sphere\Core\Client\JsonEndpoint;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\ContextAwareInterface;
use Sphere\Core\Model\Common\ContextTrait;
use Sphere\Core\Model\Common\JsonDeserializeInterface;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\OfTrait;
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
     * @param ResponseInterface $response
     * @return AbstractApiResponse
     * @internal
     */
    abstract public function buildResponse(ResponseInterface $response);

    /**
     * @param array $result
     * @param Context $context
     * @return JsonDeserializeInterface
     */
    abstract public function mapResult(array $result, Context $context = null);
}
