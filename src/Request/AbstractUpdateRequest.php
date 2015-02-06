<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:22
 */

namespace Sphere\Core\Request;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\JsonEndpoint;
use Sphere\Core\Client\JsonRequest;
use Sphere\Core\Response\SingleResourceResponse;

/**
 * Class AbstractUpdateRequest
 * @package Sphere\Core\Request
 */
abstract class AbstractUpdateRequest extends AbstractApiRequest
{
    const ACTION = 'action';

    /**
     * @var
     */
    protected $id;

    /**
     * @var int
     */
    protected $version;

    /**
     * @var array
     */
    protected $actions = [];

    /**
     * @param JsonEndpoint $endpoint
     * @param $id
     * @param $version
     * @param array $actions
     */
    public function __construct($endpoint, $id, $version, array $actions = [])
    {
        parent::__construct($endpoint);
        $this->setId($id)->setVersion($version)->setActions($actions);
    }

    /**
     * @return array
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * @param array $actions
     */
    public function setActions(array $actions)
    {
        $this->actions = $actions;

        return $this;
    }

    /**
     * @param array $action
     * @return $this
     */
    public function addAction(array $action)
    {
        $this->actions[] = $action;

        return $this;
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
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/' . $this->getId();
    }

    /**
     * @return JsonRequest
     * @internal
     */
    public function httpRequest()
    {
        $payload = ['version' => $this->getVersion(), 'actions' => $this->getActions()];
        return new JsonRequest(HttpMethod::POST, $this->getPath(), $payload);
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
