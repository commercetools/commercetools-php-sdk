<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:25
 */

namespace Sphere\Core\Request;


use Psr\Http\Message\ResponseInterface;
use Sphere\Core\Client;
use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\HttpRequest;
use Sphere\Core\Client\JsonEndpoint;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Response\ResourceResponse;

/**
 * @package Sphere\Core\Request
 * @method ResourceResponse executeWithClient(Client $client)
 */
abstract class AbstractByIdGetRequest extends AbstractApiRequest
{
    use ExpandTrait;

    /**
     * @var string
     */
    protected $id;

    /**
     * @param JsonEndpoint $endpoint
     * @param string $id
     * @param Context $context
     */
    public function __construct(JsonEndpoint $endpoint, $id, Context $context = null)
    {
        parent::__construct($endpoint, $context);
        $this->setId($id);
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/' . $this->getId() . $this->getParamString();
    }

    /**
     * @return HttpRequest
     * @internal
     */
    public function httpRequest()
    {
        return new HttpRequest(HttpMethod::GET, $this->getPath());
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
