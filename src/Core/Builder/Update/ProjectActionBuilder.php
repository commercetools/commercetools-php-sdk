<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\Project\Command\ProjectSetShippingRateInputTypeAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeCurrenciesAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeLanguagesAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeNameAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeMessagesEnabledAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeCountriesAction;

class ProjectActionBuilder
{
    /**
     * @return ProjectSetShippingRateInputTypeAction
     */
    public function setShippingRateInputType()
    {
        return ProjectSetShippingRateInputTypeAction::of();
    }

    /**
     * @return ProjectChangeCurrenciesAction
     */
    public function changeCurrencies()
    {
        return ProjectChangeCurrenciesAction::of();
    }

    /**
     * @return ProjectChangeLanguagesAction
     */
    public function changeLanguages()
    {
        return ProjectChangeLanguagesAction::of();
    }

    /**
     * @return ProjectChangeNameAction
     */
    public function changeName()
    {
        return ProjectChangeNameAction::of();
    }

    /**
     * @return ProjectChangeMessagesEnabledAction
     */
    public function changeMessagesEnabled()
    {
        return ProjectChangeMessagesEnabledAction::of();
    }

    /**
     * @return ProjectChangeCountriesAction
     */
    public function changeCountries()
    {
        return ProjectChangeCountriesAction::of();
    }
}
