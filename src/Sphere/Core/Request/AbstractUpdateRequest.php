<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:22
 */

namespace Sphere\Core\Request;


use Sphere\Core\Http\HttpMethod;
use Sphere\Core\Http\JsonRequest;

abstract class AbstractUpdateRequest extends AbstractApiRequest
{
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
     * @param \Sphere\Core\Http\JsonEndpoint $endpoint
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
    }

    public function addAction(array $action)
    {
        $this->actions[] = $action;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
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
            HttpMethod::POST,
            (string)$this->getEndpoint() . '/' . $this->getId(),
            ['version' => $this->getVersion(), 'actions' => $this->getActions()]
        );
    }
}
