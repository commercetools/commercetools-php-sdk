<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeCountriesAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeCountryTaxRateFallbackEnabledAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeCurrenciesAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeLanguagesAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeMessagesConfigurationAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeMessagesEnabledAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeNameAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeOrderSearchStatusAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeProductSearchIndexingEnabledAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeShoppingListsConfigurationAction;
use Commercetools\Core\Request\Project\Command\ProjectSetExternalOAuthAction;
use Commercetools\Core\Request\Project\Command\ProjectSetShippingRateInputTypeAction;

class ProjectActionBuilder
{
    private $actions = [];

    /**
     * @link https://docs.commercetools.com/http-api-projects-project.html#change-countries
     * @param ProjectChangeCountriesAction|callable $action
     * @return $this
     */
    public function changeCountries($action = null)
    {
        $this->addAction($this->resolveAction(ProjectChangeCountriesAction::class, $action));
        return $this;
    }

    /**
     *
     * @param ProjectChangeCountryTaxRateFallbackEnabledAction|callable $action
     * @return $this
     */
    public function changeCountryTaxRateFallbackEnabled($action = null)
    {
        $this->addAction($this->resolveAction(ProjectChangeCountryTaxRateFallbackEnabledAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-project.html#change-currencies
     * @param ProjectChangeCurrenciesAction|callable $action
     * @return $this
     */
    public function changeCurrencies($action = null)
    {
        $this->addAction($this->resolveAction(ProjectChangeCurrenciesAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-project.html#change-languages
     * @param ProjectChangeLanguagesAction|callable $action
     * @return $this
     */
    public function changeLanguages($action = null)
    {
        $this->addAction($this->resolveAction(ProjectChangeLanguagesAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-project.html#change-messages-enabled
     * @param ProjectChangeMessagesConfigurationAction|callable $action
     * @return $this
     */
    public function changeMessagesConfiguration($action = null)
    {
        $this->addAction($this->resolveAction(ProjectChangeMessagesConfigurationAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-project.html#change-messages-enabled
     * @param ProjectChangeMessagesEnabledAction|callable $action
     * @return $this
     */
    public function changeMessagesEnabled($action = null)
    {
        $this->addAction($this->resolveAction(ProjectChangeMessagesEnabledAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-project.html#change-name
     * @param ProjectChangeNameAction|callable $action
     * @return $this
     */
    public function changeName($action = null)
    {
        $this->addAction($this->resolveAction(ProjectChangeNameAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/api/projects/project#change-product-search-indexing-status
     * @param ProjectChangeOrderSearchStatusAction|callable $action
     * @return $this
     */
    public function changeOrderSearchStatus($action = null)
    {
        $this->addAction($this->resolveAction(ProjectChangeOrderSearchStatusAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/api/projects/project#change-product-search-indexing-enabled
     * @param ProjectChangeProductSearchIndexingEnabledAction|callable $action
     * @return $this
     */
    public function changeProductSearchIndexingEnabled($action = null)
    {
        $this->addAction($this->resolveAction(ProjectChangeProductSearchIndexingEnabledAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-project.html#change-shopping-lists-configuration
     * @param ProjectChangeShoppingListsConfigurationAction|callable $action
     * @return $this
     */
    public function changeShoppingListsConfiguration($action = null)
    {
        $this->addAction($this->resolveAction(ProjectChangeShoppingListsConfigurationAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-project.html#set-externaloauth
     * @param ProjectSetExternalOAuthAction|callable $action
     * @return $this
     */
    public function setExternalOAuth($action = null)
    {
        $this->addAction($this->resolveAction(ProjectSetExternalOAuthAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-project.html#set-shippingrateinputtype
     * @param ProjectSetShippingRateInputTypeAction|callable $action
     * @return $this
     */
    public function setShippingRateInputType($action = null)
    {
        $this->addAction($this->resolveAction(ProjectSetShippingRateInputTypeAction::class, $action));
        return $this;
    }

    /**
     * @return ProjectActionBuilder
     */
    public static function of()
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
