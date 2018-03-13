<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:22
 */

namespace Commercetools\Core\Request;

use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\JsonEndpoint;
use Commercetools\Core\Client\JsonRequest;
use Commercetools\Core\Error\Message;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\ContextAwareInterface;
use Commercetools\Core\Response\ResourceResponse;
use Commercetools\Core\Error\UpdateActionLimitException;

/**
 * @package Commercetools\Core\Request
 */
abstract class AbstractUpdateRequest extends AbstractApiRequest
{
    use ExpandTrait;

    const ACTION = 'action';
    const ACTIONS = 'actions';
    const VERSION = 'version';
    const ACTION_MAX_LIMIT = 500;
    const ACTION_WARNING_TRESHOLD = 400;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var int
     */
    protected $version;

    /**
     * @var AbstractAction[]
     */
    protected $actions = [];

    protected $overLimit = false;

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
     * @return AbstractAction[]
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * @return bool
     */
    public function hasActions()
    {
        return (0 !== count($this->actions));
    }

    /**
     * @param AbstractAction[] $actions
     * @return $this
     */
    public function setActions(array $actions)
    {
        $this->actions = [];
        foreach ($actions as $action) {
            if ($action instanceof AbstractAction) {
                $this->addAction($action);
            } elseif (is_array($action)) {
                $this->addActionAsArray($action);
            }
        }

        return $this;
    }

    /**
     * @param AbstractAction $action
     * @return $this
     */
    public function addAction(AbstractAction $action)
    {
        $this->actions[] = $action;
        if ($action instanceof ContextAwareInterface) {
            $action->setContextIfNull($this->getContextCallback());
        }
        $this->checkActionLimit();

        return $this;
    }

    /**
     * @param array $action
     * @return $this
     */
    public function addActionAsArray(array $action)
    {
        $this->actions[] = $action;
        $this->checkActionLimit();

        return $this;
    }

    protected function checkActionLimit()
    {
        if (count($this->actions) > static::ACTION_MAX_LIMIT) {
            $message = sprintf(
                Message::UPDATE_ACTION_LIMIT,
                $this->getPath(),
                static::ACTION_WARNING_TRESHOLD
            );
            throw new UpdateActionLimitException($message);
        }
        if (!$this->overLimit && count($this->actions) > static::ACTION_WARNING_TRESHOLD) {
            $this->overLimit = true;
            $logger = $this->getContext()->getLogger();
            if (!is_null($logger)) {
                $message = sprintf(
                    Message::UPDATE_ACTION_LIMIT_WARNING,
                    $this->getPath(),
                    static::ACTION_WARNING_TRESHOLD
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
        return (string)$this->getEndpoint() . '/' . $this->getId()  . $this->getParamString();
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
     * @return ResourceResponse
     * @internal
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new ResourceResponse($response, $this, $this->getContext());
    }
}
