<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:34
 */

namespace Sphere\Core\Request;


use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\JsonEndpoint;
use Sphere\Core\Client\JsonRequest;
use Sphere\Core\Error\InvalidArgumentException;
use Sphere\Core\Response\SingleResourceResponse;

/**
 * Class AbstractCreateRequest
 * @package Sphere\Core\Request
 */
abstract class AbstractCreateRequest extends AbstractApiRequest
{
    /**
     * @var mixed
     */
    protected $object;

    /**
     * @param JsonEndpoint $endpoint
     * @param $object
     */
    public function __construct(JsonEndpoint $endpoint, $object)
    {
        parent::__construct($endpoint);
        $this->setObject($object);
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param $object
     * @return $this
     */
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * @return JsonRequest
     * @internal
     */
    public function httpRequest()
    {
        return new JsonRequest(HttpMethod::POST, (string)$this->endpoint, $this->getObject());
    }

    /**
     * @param ResponseInterface $response
     * @return SingleResourceResponse
     * @internal
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new SingleResourceResponse($response, $this, $this->getContext());
    }
}
