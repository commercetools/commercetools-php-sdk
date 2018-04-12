<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\Project\Command\ProjectChangeCountriesAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeCurrenciesAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeLanguagesAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeMessagesEnabledAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeNameAction;
use Commercetools\Core\Request\Project\Command\ProjectSetShippingRateInputTypeAction;

class ProjectActionBuilder
{
    /**
     * @link https://docs.commercetools.com/http-api-projects-project.html#change-countries
     * @param array $data
     * @return ProjectChangeCountriesAction
     */
    public function changeCountries(array $data = [])
    {
        return ProjectChangeCountriesAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-project.html#change-currencies
     * @param array $data
     * @return ProjectChangeCurrenciesAction
     */
    public function changeCurrencies(array $data = [])
    {
        return ProjectChangeCurrenciesAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-project.html#change-languages
     * @param array $data
     * @return ProjectChangeLanguagesAction
     */
    public function changeLanguages(array $data = [])
    {
        return ProjectChangeLanguagesAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-project.html#change-messages-enabled
     * @param array $data
     * @return ProjectChangeMessagesEnabledAction
     */
    public function changeMessagesEnabled(array $data = [])
    {
        return ProjectChangeMessagesEnabledAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-project.html#change-name
     * @param array $data
     * @return ProjectChangeNameAction
     */
    public function changeName(array $data = [])
    {
        return ProjectChangeNameAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-project.html#set-shippingrateinputtype
     * @param array $data
     * @return ProjectSetShippingRateInputTypeAction
     */
    public function setShippingRateInputType(array $data = [])
    {
        return ProjectSetShippingRateInputTypeAction::fromArray($data);
    }

    /**
     * @return ProjectActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
