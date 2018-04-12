<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\Reviews\Command\ReviewSetAuthorNameAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetCustomerAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetKeyAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetLocaleAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetRatingAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetTargetAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetTextAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetTitleAction;
use Commercetools\Core\Request\Reviews\Command\ReviewTransitionStateAction;

class ReviewsActionBuilder
{
    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#set-author-name
     * @param array $data
     * @return ReviewSetAuthorNameAction
     */
    public function setAuthorName(array $data = [])
    {
        return ReviewSetAuthorNameAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#set-customer
     * @param array $data
     * @return ReviewSetCustomerAction
     */
    public function setCustomer(array $data = [])
    {
        return ReviewSetCustomerAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#set-key
     * @param array $data
     * @return ReviewSetKeyAction
     */
    public function setKey(array $data = [])
    {
        return ReviewSetKeyAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#set-locale
     * @param array $data
     * @return ReviewSetLocaleAction
     */
    public function setLocale(array $data = [])
    {
        return ReviewSetLocaleAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#set-rating
     * @param array $data
     * @return ReviewSetRatingAction
     */
    public function setRating(array $data = [])
    {
        return ReviewSetRatingAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#set-target
     * @param array $data
     * @return ReviewSetTargetAction
     */
    public function setTarget(array $data = [])
    {
        return ReviewSetTargetAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#set-text
     * @param array $data
     * @return ReviewSetTextAction
     */
    public function setText(array $data = [])
    {
        return ReviewSetTextAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#set-title
     * @param array $data
     * @return ReviewSetTitleAction
     */
    public function setTitle(array $data = [])
    {
        return ReviewSetTitleAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#transition-state
     * @param array $data
     * @return ReviewTransitionStateAction
     */
    public function transitionState(array $data = [])
    {
        return ReviewTransitionStateAction::fromArray($data);
    }

    /**
     * @return ReviewsActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
