<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CustomObjects;


use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\HttpRequest;
use Sphere\Core\Client\JsonRequest;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractApiRequest;
use Sphere\Core\Response\SingleResourceResponse;

/**
 * Class CustomObjectsDeleteByKeyRequest
 * @package Sphere\Core\Request\CustomObjects
 */
class CustomObjectDeleteByKeyRequest extends AbstractApiRequest
{
    protected $resultClass = '\Sphere\Core\Model\Common\JsonObject';

    /**
     * @var string
     */
    protected $container;

    /**
     * @var string
     */
    protected $key;

    /**
     * @param string $container
     * @param string $key
     * @param Context $context
     */
    public function __construct($container, $key, Context $context = null)
    {
        parent::__construct(CustomObjectsEndpoint::endpoint(), $context);
        $this->container = $container;
        $this->key = $key;
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/' . $this->container . '/' . $this->key;
    }

    /**
     * @return JsonRequest
     * @internal
     */
    public function httpRequest()
    {
        return new HttpRequest(HttpMethod::DELETE, $this->getPath());
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
