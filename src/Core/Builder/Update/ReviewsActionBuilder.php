<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetAuthorNameAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetCustomFieldAction;
use Commercetools\Core\Request\Reviews\Command\ReviewSetCustomTypeAction;
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
    private $actions = [];

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#set-author-name
     * @param ReviewSetAuthorNameAction|callable $action
     * @return $this
     */
    public function setAuthorName($action = null)
    {
        $this->addAction($this->resolveAction(ReviewSetAuthorNameAction::class, $action));
        return $this;
    }

    /**
     *
     * @param ReviewSetCustomFieldAction|callable $action
     * @return $this
     */
    public function setCustomField($action = null)
    {
        $this->addAction($this->resolveAction(ReviewSetCustomFieldAction::class, $action));
        return $this;
    }

    /**
     *
     * @param ReviewSetCustomTypeAction|callable $action
     * @return $this
     */
    public function setCustomType($action = null)
    {
        $this->addAction($this->resolveAction(ReviewSetCustomTypeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#set-customer
     * @param ReviewSetCustomerAction|callable $action
     * @return $this
     */
    public function setCustomer($action = null)
    {
        $this->addAction($this->resolveAction(ReviewSetCustomerAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#set-key
     * @param ReviewSetKeyAction|callable $action
     * @return $this
     */
    public function setKey($action = null)
    {
        $this->addAction($this->resolveAction(ReviewSetKeyAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#set-locale
     * @param ReviewSetLocaleAction|callable $action
     * @return $this
     */
    public function setLocale($action = null)
    {
        $this->addAction($this->resolveAction(ReviewSetLocaleAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#set-rating
     * @param ReviewSetRatingAction|callable $action
     * @return $this
     */
    public function setRating($action = null)
    {
        $this->addAction($this->resolveAction(ReviewSetRatingAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#set-target
     * @param ReviewSetTargetAction|callable $action
     * @return $this
     */
    public function setTarget($action = null)
    {
        $this->addAction($this->resolveAction(ReviewSetTargetAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#set-text
     * @param ReviewSetTextAction|callable $action
     * @return $this
     */
    public function setText($action = null)
    {
        $this->addAction($this->resolveAction(ReviewSetTextAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#set-title
     * @param ReviewSetTitleAction|callable $action
     * @return $this
     */
    public function setTitle($action = null)
    {
        $this->addAction($this->resolveAction(ReviewSetTitleAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-reviews.html#transition-state
     * @param ReviewTransitionStateAction|callable $action
     * @return $this
     */
    public function transitionState($action = null)
    {
        $this->addAction($this->resolveAction(ReviewTransitionStateAction::class, $action));
        return $this;
    }

    /**
     * @return ReviewsActionBuilder
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
