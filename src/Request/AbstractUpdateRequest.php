<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:22
 */

namespace Sphere\Core\Request;


use Psr\Http\Message\ResponseInterface;
use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\JsonEndpoint;
use Sphere\Core\Client\JsonRequest;
use Sphere\Core\Error\Message;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\ContextAwareInterface;
use Sphere\Core\Response\SingleResourceResponse;

/**
 * Class AbstractUpdateRequest
 * @package Sphere\Core\Request
 */
abstract class AbstractUpdateRequest extends AbstractApiRequest
{
    const ACTION = 'action';
    const ACTIONS = 'actions';
    const VERSION = 'version';
    const ACTION_LIMIT = 50;

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
     * @param string $id
     * @param int $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($endpoint, $id, $version, array $actions = [], Context $context = null)
    {
        parent::__construct($endpoint, $context);
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
     * @return $this
     */
    public function setActions(array $actions)
    {
        $this->actions = $actions;
        $this->logUpdateActionLimit();

        return $this;
    }

    /**
     * @param array|AbstractAction $action
     * @return $this
     */
    public function addAction($action)
    {
        $this->actions[] = $action;
        if ($action instanceof ContextAwareInterface) {
            $action->setContextIfNull($this->getContextCallback());
        }
        $this->logUpdateActionLimit();

        return $this;
    }

    protected function logUpdateActionLimit()
    {
        if (count($this->actions) > static::ACTION_LIMIT) {
            $logger = $this->getContext()->getLogger();
            if (!is_null($logger)) {
                $message = sprintf(
                    Message::UPDATE_ACTION_LIMIT,
                    $this->getPath(),
                    static::ACTION_LIMIT
                );
                $logger->warning($message);
            }
        }
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
        $payload = [static::VERSION => $this->getVersion(), static::ACTIONS => $this->getActions()];
        return new JsonRequest(HttpMethod::POST, $this->getPath(), $payload);
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
