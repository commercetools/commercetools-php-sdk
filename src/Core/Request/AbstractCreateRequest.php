<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:34
 */

namespace Commercetools\Core\Request;

use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\JsonEndpoint;
use Commercetools\Core\Client\JsonRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Response\ResourceResponse;

/**
 * @package Commercetools\Core\Request
 * @method ResourceResponse executeWithClient(Client $client)
 */
abstract class AbstractCreateRequest extends AbstractApiRequest
{
    use ExpandTrait;

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
