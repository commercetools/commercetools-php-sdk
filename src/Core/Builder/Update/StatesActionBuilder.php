<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\States\Command\StateSetDescriptionAction;
use Commercetools\Core\Request\States\Command\StateChangeTypeAction;
use Commercetools\Core\Request\States\Command\TransitionStateAction;
use Commercetools\Core\Request\States\Command\StateRemoveRolesAction;
use Commercetools\Core\Request\States\Command\StateSetNameAction;
use Commercetools\Core\Request\States\Command\StateAddRolesAction;
use Commercetools\Core\Request\States\Command\StateChangeInitialAction;
use Commercetools\Core\Request\States\Command\StateSetTransitionsAction;
use Commercetools\Core\Request\States\Command\StateChangeKeyAction;
use Commercetools\Core\Request\States\Command\StateSetRolesAction;

class StatesActionBuilder
{
    /**
     * @link https://docs.commercetools.com/http-api-projects-states.html#set-state-description
     * @param array $data
     * @return StateSetDescriptionAction
     */
    public function setDescription(array $data = [])
    {
        return new StateSetDescriptionAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-states.html#change-state-type
     * @param array $data
     * @return StateChangeTypeAction
     */
    public function changeType(array $data = [])
    {
        return new StateChangeTypeAction($data);
    }

    /**
     *
     * @param array $data
     * @return TransitionStateAction
     */
    public function transitionState(array $data = [])
    {
        return new TransitionStateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-states.html#remove-state-roles
     * @param array $data
     * @return StateRemoveRolesAction
     */
    public function removeRoles(array $data = [])
    {
        return new StateRemoveRolesAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-states.html#set-state-name
     * @param array $data
     * @return StateSetNameAction
     */
    public function setName(array $data = [])
    {
        return new StateSetNameAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-states.html#add-state-roles
     * @param array $data
     * @return StateAddRolesAction
     */
    public function addRoles(array $data = [])
    {
        return new StateAddRolesAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-states.html#change-initial-state
     * @param array $data
     * @return StateChangeInitialAction
     */
    public function changeInitial(array $data = [])
    {
        return new StateChangeInitialAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-states.html#set-transitions
     * @param array $data
     * @return StateSetTransitionsAction
     */
    public function setTransitions(array $data = [])
    {
        return new StateSetTransitionsAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-states.html#change-state-key
     * @param array $data
     * @return StateChangeKeyAction
     */
    public function changeKey(array $data = [])
    {
        return new StateChangeKeyAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-states.html#set-state-roles
     * @param array $data
     * @return StateSetRolesAction
     */
    public function setRoles(array $data = [])
    {
        return new StateSetRolesAction($data);
    }

    /**
     * @return StatesActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
