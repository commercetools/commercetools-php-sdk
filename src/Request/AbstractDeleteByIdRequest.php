<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:22
 */

namespace Sphere\Core\Request;


use Sphere\Core\Http\HttpMethod;
use Sphere\Core\Http\JsonRequest;

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
     * @param string $id
     */
    public function __construct($endpoint, $id, $version)
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
     * @return JsonRequest
     */
    public function httpRequest()
    {
        return new JsonRequest(
            HttpMethod::DELETE,
            (string)$this->getEndpoint() . '/' . $this->getId(),
            ['version' => $this->getVersion()]
        );
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
