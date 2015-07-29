<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:34
 */

namespace Sphere\Core\Request;


use Psr\Http\Message\ResponseInterface;
use Sphere\Core\Client;
use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\JsonEndpoint;
use Sphere\Core\Client\JsonRequest;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Response\ResourceResponse;

/**
 * @package Sphere\Core\Request
 * @method ResourceResponse executeWithClient(Client $client)
 */
abstract class AbstractCreateRequest extends AbstractApiRequest
{
    /**
     * @var mixed
     */
    protected $object;

    /**
     * @param JsonEndpoint $endpoint
     * @param mixed $object
     * @param Context $context
     */
    public function __construct(JsonEndpoint $endpoint, $object, Context $context = null)
    {
        parent::__construct($endpoint, $context);
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
        return new JsonRequest(HttpMethod::POST, (string)$this->getPath(), $this->getObject());
    }

    /**
     * @param ResponseInterface $response
     * @return ResourceResponse
     * @internal
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new ResourceResponse($response, $this, $this->getContext());
    }
}
