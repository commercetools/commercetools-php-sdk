<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:25
 */

namespace Commercetools\Core\Request;


use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\HttpRequest;
use Commercetools\Core\Client\JsonEndpoint;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Response\ResourceResponse;

/**
 * @package Commercetools\Core\Request
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
