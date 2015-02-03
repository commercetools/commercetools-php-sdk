<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:22
 */

namespace Sphere\Core\Request;


use Sphere\Core\Http\HttpMethod;
use Sphere\Core\Http\JsonEndpoint;
use Sphere\Core\Http\JsonRequest;
use Sphere\Core\Response\SingleResourceResponse;

/**
 * Class AbstractDeleteByIdRequest
 * @package Sphere\Core\Request
 */
abstract class AbstractDeleteByIdRequest extends AbstractApiRequest
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var int
     */
    protected $version;

    /**
     * @param JsonEndpoint $endpoint
     * @param $id
     * @param $version
     */
    public function __construct(JsonEndpoint $endpoint, $id, $version)
    {
        parent::__construct($endpoint);
        $this->setId($id);
        $this->setVersion($version);
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param int $version
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return string
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/' . $this->getId();
    }

    /**
     * @return JsonRequest
     */
    public function httpRequest()
    {
        return new JsonRequest(HttpMethod::DELETE, $this->getPath(), ['version' => $this->getVersion()]);
    }

    /**
     * @param $response
     * @return SingleResourceResponse
     */
    public function buildResponse($response)
    {
        return new SingleResourceResponse($response, $this);
    }
}
