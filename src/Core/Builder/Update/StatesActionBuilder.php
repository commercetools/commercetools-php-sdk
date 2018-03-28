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
     * @return StateSetDescriptionAction
     */
    public function setDescription()
    {
        return StateSetDescriptionAction::of();
    }

    /**
     * @return StateChangeTypeAction
     */
    public function changeType()
    {
        return StateChangeTypeAction::of();
    }

    /**
     * @return TransitionStateAction
     */
    public function transitionState()
    {
        return TransitionStateAction::of();
    }

    /**
     * @return StateRemoveRolesAction
     */
    public function removeRoles()
    {
        return StateRemoveRolesAction::of();
    }

    /**
     * @return StateSetNameAction
     */
    public function setName()
    {
        return StateSetNameAction::of();
    }

    /**
     * @return StateAddRolesAction
     */
    public function addRoles()
    {
        return StateAddRolesAction::of();
    }

    /**
     * @return StateChangeInitialAction
     */
    public function changeInitial()
    {
        return StateChangeInitialAction::of();
    }

    /**
     * @return StateSetTransitionsAction
     */
    public function setTransitions()
    {
        return StateSetTransitionsAction::of();
    }

    /**
     * @return StateChangeKeyAction
     */
    public function changeKey()
    {
        return StateChangeKeyAction::of();
    }

    /**
     * @return StateSetRolesAction
     */
    public function setRoles()
    {
        return StateSetRolesAction::of();
    }
}
