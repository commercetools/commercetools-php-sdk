<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\Channels\Command\ChannelAddRolesAction;
use Commercetools\Core\Request\Channels\Command\ChannelChangeDescriptionAction;
use Commercetools\Core\Request\Channels\Command\ChannelChangeKeyAction;
use Commercetools\Core\Request\Channels\Command\ChannelChangeNameAction;
use Commercetools\Core\Request\Channels\Command\ChannelRemoveRolesAction;
use Commercetools\Core\Request\Channels\Command\ChannelSetAddressAction;
use Commercetools\Core\Request\Channels\Command\ChannelSetCustomFieldAction;
use Commercetools\Core\Request\Channels\Command\ChannelSetCustomTypeAction;
use Commercetools\Core\Request\Channels\Command\ChannelSetGeoLocation;
use Commercetools\Core\Request\Channels\Command\ChannelSetRolesAction;

class ChannelsActionBuilder
{
    private $actions = [];

    /**
     * @link https://docs.commercetools.com/http-api-projects-channels.html#add-roles
     * @param ChannelAddRolesAction|callable $action
     * @return $this
     */
    public function addRoles($action = null)
    {
        $this->addAction($this->resolveAction(ChannelAddRolesAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-channels.html#change-description
     * @param ChannelChangeDescriptionAction|callable $action
     * @return $this
     */
    public function changeDescription($action = null)
    {
        $this->addAction($this->resolveAction(ChannelChangeDescriptionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-channels.html#change-key
     * @param ChannelChangeKeyAction|callable $action
     * @return $this
     */
    public function changeKey($action = null)
    {
        $this->addAction($this->resolveAction(ChannelChangeKeyAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-channels.html#change-name
     * @param ChannelChangeNameAction|callable $action
     * @return $this
     */
    public function changeName($action = null)
    {
        $this->addAction($this->resolveAction(ChannelChangeNameAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-channels.html#remove-roles
     * @param ChannelRemoveRolesAction|callable $action
     * @return $this
     */
    public function removeRoles($action = null)
    {
        $this->addAction($this->resolveAction(ChannelRemoveRolesAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-channels.html#set-address
     * @param ChannelSetAddressAction|callable $action
     * @return $this
     */
    public function setAddress($action = null)
    {
        $this->addAction($this->resolveAction(ChannelSetAddressAction::class, $action));
        return $this;
    }

    /**
     *
     * @param ChannelSetCustomFieldAction|callable $action
     * @return $this
     */
    public function setCustomField($action = null)
    {
        $this->addAction($this->resolveAction(ChannelSetCustomFieldAction::class, $action));
        return $this;
    }

    /**
     *
     * @param ChannelSetCustomTypeAction|callable $action
     * @return $this
     */
    public function setCustomType($action = null)
    {
        $this->addAction($this->resolveAction(ChannelSetCustomTypeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-channels.html#set-geolocation
     * @param ChannelSetGeoLocation|callable $action
     * @return $this
     */
    public function setGeoLocation($action = null)
    {
        $this->addAction($this->resolveAction(ChannelSetGeoLocation::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-channels.html#set-roles
     * @param ChannelSetRolesAction|callable $action
     * @return $this
     */
    public function setRoles($action = null)
    {
        $this->addAction($this->resolveAction(ChannelSetRolesAction::class, $action));
        return $this;
    }

    /**
     * @return ChannelsActionBuilder
     */
    public function of()
    {
        return new self();
    }

    /**
     * @param $class
     * @param $action
     * @return AbstractAction
     * @throws InvalidArgumentException
     */
    private function resolveAction($class, $action = null)
    {
        if (is_null($action) || is_callable($action)) {
            $callback = $action;
            $emptyAction = $class::of();
            $action = $this->callback($emptyAction, $callback);
        }
        if ($action instanceof $class) {
            return $action;
        }
        throw new InvalidArgumentException(
            sprintf('Expected method to be called with or callable to return %s', $class)
        );
    }

    /**
     * @param $action
     * @param callable $callback
     * @return AbstractAction
     */
    private function callback($action, callable $callback = null)
    {
        if (!is_null($callback)) {
            $action = $callback($action);
        }
        return $action;
    }

    /**
     * @param AbstractAction $action
     * @return $this;
     */
    public function addAction(AbstractAction $action)
    {
        $this->actions[] = $action;
        return $this;
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
        return $this;
    }
}
