<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\Reviews\Command\ReviewSetKeyAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetCustomerAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetTitleAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetTextAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetTargetAction;
use Commercetools\Core\Request\Reviews\Command\ReviewTransitionStateAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetRatingAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetLocaleAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetAuthorNameAction;

class ReviewsActionBuilder
{
    /**
     * @return ReviewSetKeyAction
     */
    public function setKey()
    {
        return ReviewSetKeyAction::of();
    }

    /**
     * @return ReviewSetCustomerAction
     */
    public function setCustomer()
    {
        return ReviewSetCustomerAction::of();
    }

    /**
     * @return ReviewSetTitleAction
     */
    public function setTitle()
    {
        return ReviewSetTitleAction::of();
    }

    /**
     * @return ReviewSetTextAction
     */
    public function setText()
    {
        return ReviewSetTextAction::of();
    }

    /**
     * @return ReviewSetTargetAction
     */
    public function setTarget()
    {
        return ReviewSetTargetAction::of();
    }

    /**
     * @return ReviewTransitionStateAction
     */
    public function transitionState()
    {
        return ReviewTransitionStateAction::of();
    }

    /**
     * @return ReviewSetRatingAction
     */
    public function setRating()
    {
        return ReviewSetRatingAction::of();
    }

    /**
     * @return ReviewSetLocaleAction
     */
    public function setLocale()
    {
        return ReviewSetLocaleAction::of();
    }

    /**
     * @return ReviewSetAuthorNameAction
     */
    public function setAuthorName()
    {
        return ReviewSetAuthorNameAction::of();
    }
}
