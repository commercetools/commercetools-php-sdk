<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:25
 */

namespace Sphere\Core\Request;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\HttpRequest;
use Sphere\Core\Client\JsonEndpoint;
use Sphere\Core\Response\SingleResourceResponse;

/**
 * Class AbstractFetchByIdRequest
 * @package Sphere\Core\Request
 */
abstract class AbstractFetchByIdRequest extends AbstractApiRequest
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @param JsonEndpoint $endpoint
     * @param string $id
     */
    public function __construct(JsonEndpoint $endpoint, $id)
    {
        parent::__construct($endpoint);
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
        return (string)$this->getEndpoint() . '/' . $this->getId();
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
     * @param $response
     * @return SingleResourceResponse
     * @internal
     */
    public function buildResponse($response)
    {
        return new SingleResourceResponse($response, $this);
    }
}
