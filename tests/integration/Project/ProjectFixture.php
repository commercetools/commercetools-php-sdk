<?php

namespace Commercetools\Core\IntegrationTests\Project;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Client;
use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\Model\Message\MessagesConfigurationDraft;
use Commercetools\Core\Model\Project\Project;
use Commercetools\Core\Request\Project\Command\ProjectChangeCountriesAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeCountryTaxRateFallbackEnabledAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeCurrenciesAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeLanguagesAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeMessagesConfigurationAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeProductSearchIndexingEnabledAction;
use Commercetools\Core\Request\Project\Command\ProjectSetShippingRateInputTypeAction;
use Commercetools\Core\Request\Project\ProjectGetRequest;
use Commercetools\Core\Request\Project\ProjectUpdateRequest;

class ProjectFixture extends ResourceFixture
{
    private static function emptyFunction(ProjectUpdateRequest $request)
    {
        return $request;
    }

    final public static function setupProject(ApiClient $client)
    {
        $request = RequestBuilder::of()->project()->get();
        $response = $client->execute($request);
        $project = $request->mapFromResponse($response);

        $request = ProjectUpdateRequest::ofVersion($project->getVersion());

        $currencies = $project->getCurrencies()->toArray();
        if (!in_array('EUR', $currencies) || !in_array('USD', $currencies)) {
            $request->addAction(ProjectChangeCurrenciesAction::ofCurrencies(['EUR', 'USD']));
        }
        $languages = $project->getLanguages()->toArray();
        if (!in_array('en', $languages) || !in_array('de', $languages) || !in_array('de-DE', $languages)) {
            $request->addAction(ProjectChangeLanguagesAction::ofLanguages(['en', 'de', 'de-DE']));
        }
        $countries = $project->getCountries()->toArray();
        if (!in_array('FR', $countries) || !in_array('DE', $countries) || !in_array('ES', $countries) || !in_array('US', $countries)) {
            $request->addAction(ProjectChangeCountriesAction::ofCountries(['FR', 'DE', 'ES', 'US']));
        }
        if ($project->getMessages()->getEnabled() === false) {
            $request->addAction(ProjectChangeMessagesConfigurationAction::ofDraft(
                MessagesConfigurationDraft::ofEnabledAndDeleteDaysAfterCreation(
                    true,
                    15
                )
            ));
        }
        if ($project->getShippingRateInputType() != null) {
            $request->addAction(ProjectSetShippingRateInputTypeAction::of());
        }
        if ($project->getCarts() != null && $project->getCarts()->getCountryTaxRateFallbackEnabled() == true) {
            $request->addAction(ProjectChangeCountryTaxRateFallbackEnabledAction::ofCountryTaxRateFallbackEnabled(false));
        }
        if ($project->getSearchIndexing() === null) {
            $request->addAction(ProjectChangeProductSearchIndexingEnabledAction::ofEnabled(false));
        }

        if ($request->hasActions()) {
            $response = $client->execute($request);
            $project = $request->mapFromResponse($response);
        }

        return $project;
    }

    final public static function projectGetFunction(ApiClient $client)
    {
        $request = RequestBuilder::of()->project()->get();
        $response = $client->execute($request);

        return $request->mapFromResponse($response);
    }

    final public static function uniqueProjectString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function withProject(
        ApiClient $client,
        callable $assertFunction
    ) {
        self::withSetupProject(
            $client,
            [__CLASS__, 'emptyFunction'],
            $assertFunction
        );
    }

    private static function updateProject(ApiClient $client, callable $setupFunction)
    {
        $project = self::projectGetFunction($client);
        $request = RequestBuilder::of()->project()->update($project);

        $projectRequest = $setupFunction($request);

        $response = $client->execute($projectRequest);
        return $request->mapFromResponse($response);
    }

    final public static function withSetupProject(
        ApiClient $client,
        callable $setupFunction,
        callable $assertFunction
    ) {
        $project = self::updateProject($client, $setupFunction);

        try {
            call_user_func($assertFunction, $project);
        } finally {
            self::setupProject($client);
        }
    }
}
