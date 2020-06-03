<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Project;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Builder\Update\ActionBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\IntegrationTests\Cart\CartFixture;
use Commercetools\Core\Model\Common\LocalizedEnum;
use Commercetools\Core\Model\Common\LocalizedEnumCollection;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Message\MessagesConfigurationDraft;
use Commercetools\Core\Model\Project\CartClassificationType;
use Commercetools\Core\Model\Project\CartScoreType;
use Commercetools\Core\Model\Project\CartValueType;
use Commercetools\Core\Model\Project\ExternalOAuth;
use Commercetools\Core\Model\Project\Project;
use Commercetools\Core\Request\Project\Command\ProjectChangeCountriesAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeCountryTaxRateFallbackEnabledAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeCurrenciesAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeLanguagesAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeMessagesConfigurationAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeMessagesEnabledAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeNameAction;
use Commercetools\Core\Request\Project\Command\ProjectSetExternalOAuthAction;
use Commercetools\Core\Request\Project\Command\ProjectSetShippingRateInputTypeAction;

class ProjectUpdateRequestTest extends ApiTestCase
{
    public function testChangeName()
    {
        $client = $this->getApiClient();

        ProjectFixture::withProject(
            $client,
            function (Project $project) use ($client) {
                $oldName = $project->getName();
                $name = "new-name-" . ProjectFixture::uniqueProjectString();

                $request = RequestBuilder::of()->project()->update($project)
                    ->addAction(ProjectChangeNameAction::ofName($name));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Project::class, $result);
                $this->assertSame($name, $result->getName());

                $request = RequestBuilder::of()->project()->update($result)
                    ->addAction(ProjectChangeNameAction::ofName($oldName));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Project::class, $result);
                $this->assertSame($oldName, $result->getName());

                return $result;
            }
        );
    }

    public function testChangeCurrencies()
    {
        $client = $this->getApiClient();

        ProjectFixture::withProject(
            $client,
            function (Project $project) use ($client) {
                $oldCurrencies = $project->getCurrencies()->toArray();
                $currencies = array_merge($oldCurrencies, ['ZWL']);

                $request = RequestBuilder::of()->project()->update($project)
                    ->addAction(ProjectChangeCurrenciesAction::ofCurrencies($currencies));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Project::class, $result);
                $this->assertContains('ZWL', $result->getCurrencies()->toArray());

                $request = RequestBuilder::of()->project()->update($result)
                    ->addAction(ProjectChangeCurrenciesAction::ofCurrencies($oldCurrencies));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Project::class, $result);
                $this->assertSame($oldCurrencies, $result->getCurrencies()->toArray());

                return $result;
            }
        );
    }

    public function testChangeCountryTaxRateFallbackEnabled()
    {
        $client = $this->getApiClient();

        ProjectFixture::withProject(
            $client,
            function (Project $project) use ($client) {
                $countryTaxRateFallbackEnabled = $project->getFlag();

                $request = RequestBuilder::of()->project()->update($project)
                    ->addAction(ProjectChangeCountryTaxRateFallbackEnabledAction::ofCountryTaxRateFallback(!$countryTaxRateFallbackEnabled));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Project::class, $result);
                $this->assertNotSame($countryTaxRateFallbackEnabled, $result->getFlag());



                return $result;
            }
        );
    }

    public function testChangeCountries()
    {
        $client = $this->getApiClient();

        ProjectFixture::withProject(
            $client,
            function (Project $project) use ($client) {
                $request = RequestBuilder::of()->project()->get();
                $response = $this->execute($client, $request);
                $project = $request->mapFromResponse($response);

                $this->assertInstanceOf(Project::class, $project);

                $oldCountries = $project->getCountries()->toArray();
                $countries = array_merge($oldCountries, ['ZW']);

                $request = RequestBuilder::of()->project()->update($project)
                    ->addAction(ProjectChangeCountriesAction::ofCountries($countries));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Project::class, $result);
                $this->assertContains('ZW', $result->getCountries()->toArray());

                $request = RequestBuilder::of()->project()->update($result)
                    ->addAction(ProjectChangeCountriesAction::ofCountries($oldCountries));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Project::class, $result);
                $this->assertSame($oldCountries, $result->getCountries()->toArray());

                return $result;
            }
        );
    }

    public function testChangeLanguages()
    {
        $client = $this->getApiClient();

        ProjectFixture::withProject(
            $client,
            function (Project $project) use ($client) {
                $oldLanguages = $project->getLanguages()->toArray();
                $languages = array_merge($oldLanguages, ['zh']);

                $request = RequestBuilder::of()->project()->update($project)
                    ->addAction(ProjectChangeLanguagesAction::ofLanguages($languages));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Project::class, $result);
                $this->assertContains('zh', $result->getLanguages()->toArray());

                $request = RequestBuilder::of()->project()->update($result)
                    ->addAction(ProjectChangeLanguagesAction::ofLanguages($oldLanguages));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Project::class, $result);
                $this->assertSame($oldLanguages, $result->getLanguages()->toArray());

                return $result;
            }
        );
    }

    public function testChangeMessagesEnabled()
    {
        $client = $this->getApiClient();

        ProjectFixture::withProject(
            $client,
            function (Project $project) use ($client) {
                $messagesEnabled = $project->getMessages()->getEnabled();

                $request = RequestBuilder::of()->project()->update($project)
                    ->addAction(ProjectChangeMessagesEnabledAction::ofMessagesEnabled(!$messagesEnabled));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Project::class, $result);
                $this->assertNotSame($messagesEnabled, $result->getMessages()->getEnabled());

                $request = RequestBuilder::of()->project()->update($result)
                    ->addAction(ProjectChangeMessagesEnabledAction::ofMessagesEnabled($messagesEnabled));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Project::class, $result);
                $this->assertSame($messagesEnabled, $result->getMessages()->getEnabled());

                return $result;
            }
        );
    }

    public function testChangeMessagesConfiguration()
    {
        $client = $this->getApiClient();

        ProjectFixture::withProject(
            $client,
            function (Project $project) use ($client) {
                $messagesConfiguration = $project->getMessages();
                $messagesEnabled = $messagesConfiguration->getEnabled();
                $deleteDaysAfterCreation = (5 === $messagesConfiguration->getDeleteDaysAfterCreation() ?  10 : 5);

                $messagesConfigurationDraft = MessagesConfigurationDraft::ofEnabledAndDeleteDaysAfterCreation(
                    !$messagesEnabled,
                    $deleteDaysAfterCreation
                );

                $request = RequestBuilder::of()->project()->update($project)
                    ->addAction(ProjectChangeMessagesConfigurationAction::ofDraft($messagesConfigurationDraft));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Project::class, $result);
                $this->assertNotSame($messagesEnabled, $result->getMessages()->getEnabled());
                $this->assertSame($deleteDaysAfterCreation, $result->getMessages()->getDeleteDaysAfterCreation());

                $messagesConfigurationDraft = MessagesConfigurationDraft::ofEnabledAndDeleteDaysAfterCreation(
                    $messagesEnabled,
                    $deleteDaysAfterCreation
                );

                $request = RequestBuilder::of()->project()->update($result)
                    ->addAction(ProjectChangeMessagesConfigurationAction::ofDraft($messagesConfigurationDraft));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Project::class, $result);
                $this->assertSame($messagesEnabled, $result->getMessages()->getEnabled());
                $this->assertSame($deleteDaysAfterCreation, $result->getMessages()->getDeleteDaysAfterCreation());

                return $result;
            }
        );
    }

    public function testSetShippingRateInputTypeCartValue()
    {
        $client = $this->getApiClient();

        ProjectFixture::withProject(
            $client,
            function (Project $project) use ($client) {
                $request = RequestBuilder::of()->project()->update($project)
                    ->addAction(
                        ProjectSetShippingRateInputTypeAction::of()
                            ->setShippingRateInputType(CartValueType::of())
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Project::class, $result);
                $this->assertInstanceOf(CartValueType::class, $result->getShippingRateInputType());
                $this->assertSame(CartValueType::INPUT_TYPE, $result->getShippingRateInputType()->getType());

                $request = RequestBuilder::of()->project()->update($result)
                    ->addAction(ProjectSetShippingRateInputTypeAction::of());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Project::class, $result);
                $this->assertNotInstanceOf(CartValueType::class, $result->getShippingRateInputType());

                return $result;
            }
        );
    }

    public function testSetShippingRateInputTypeCartScore()
    {
        $client = $this->getApiClient();

        ProjectFixture::withProject(
            $client,
            function (Project $project) use ($client) {
                $request = RequestBuilder::of()->project()->get();
                $response = $this->execute($client, $request);
                $project = $request->mapFromResponse($response);

                $this->assertInstanceOf(Project::class, $project);

                $request = RequestBuilder::of()->project()->update($project)
                    ->addAction(
                        ProjectSetShippingRateInputTypeAction::of()
                            ->setShippingRateInputType(CartScoreType::of())
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Project::class, $result);
                $this->assertInstanceOf(CartScoreType::class, $result->getShippingRateInputType());
                $this->assertSame(CartScoreType::INPUT_TYPE, $result->getShippingRateInputType()->getType());

                $request = RequestBuilder::of()->project()->update($result)
                    ->addAction(ProjectSetShippingRateInputTypeAction::of());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Project::class, $result);
                $this->assertNotInstanceOf(CartScoreType::class, $result->getShippingRateInputType());

                return $result;
            }
        );
    }

    public function testSetShippingRateInputTypeCartClassification()
    {
        $client = $this->getApiClient();

        ProjectFixture::withProject(
            $client,
            function (Project $project) use ($client) {
                $request = RequestBuilder::of()->project()->update($project)
                    ->addAction(
                        ProjectSetShippingRateInputTypeAction::of()
                            ->setShippingRateInputType(
                                CartClassificationType::of()->setValues(
                                    LocalizedEnumCollection::of()->add(
                                        LocalizedEnum::of()->setKey('small')
                                            ->setLabel(LocalizedString::ofLangAndText('en', 'small'))
                                    )->add(
                                        LocalizedEnum::of()->setKey('medium')
                                            ->setLabel(LocalizedString::ofLangAndText('en', 'medium'))
                                    )->add(
                                        LocalizedEnum::of()->setKey('large')
                                            ->setLabel(LocalizedString::ofLangAndText('en', 'large'))
                                    )
                                )
                            )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Project::class, $result);
                $this->assertInstanceOf(CartClassificationType::class, $result->getShippingRateInputType());
                $this->assertSame(CartClassificationType::INPUT_TYPE, $result->getShippingRateInputType()->getType());
                $this->assertInstanceOf(CartClassificationType::class, $result->getShippingRateInputType());
                $this->assertCount(3, $result->getShippingRateInputType()->getValues());

                $request = RequestBuilder::of()->project()->update($result)
                    ->addAction(ProjectSetShippingRateInputTypeAction::of());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Project::class, $result);
                $this->assertNotInstanceOf(CartClassificationType::class, $result->getShippingRateInputType());

                return $result;
            }
        );
    }

    public function testExternalOAuth()
    {
        $client = $this->getApiClient();

        ProjectFixture::withProject(
            $client,
            function (Project $project) use ($client) {
                $request = RequestBuilder::of()->project()->update($project)
                    ->setActions(
                        ActionBuilder::of()->project()
                            ->setExternalOAuth(
                                function (ProjectSetExternalOAuthAction $action) {
                                    $action->setExternalOAuth(
                                        ExternalOAuth::of()->setUrl("https://localhost")
                                        ->setAuthorizationHeader("Bearer")
                                    );

                                    return $action;
                                }
                            )->getActions()
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Project::class, $result);
                $this->assertInstanceOf(ExternalOAuth::class, $result->getExternalOAuth());
                $this->assertNotSame("Bearer", $result->getExternalOAuth()->getAuthorizationHeader());

                $request = RequestBuilder::of()->project()->update($result)
                    ->setActions(
                        ActionBuilder::of()->project()
                            ->setExternalOAuth(
                                function (ProjectSetExternalOAuthAction $action) {
                                    return $action;
                                }
                            )->getActions()
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertNull($result->getExternalOAuth());

                return $result;
            }
        );
    }
}
