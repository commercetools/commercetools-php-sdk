<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Project;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Common\LocalizedEnum;
use Commercetools\Core\Model\Common\LocalizedEnumCollection;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Message\MessagesConfigurationDraft;
use Commercetools\Core\Model\Project\CartClassificationType;
use Commercetools\Core\Model\Project\CartScoreType;
use Commercetools\Core\Model\Project\CartValueType;
use Commercetools\Core\Model\Project\Project;
use Commercetools\Core\Request\Project\Command\ProjectChangeCountriesAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeCurrenciesAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeLanguagesAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeMessagesConfigurationAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeMessagesEnabledAction;
use Commercetools\Core\Request\Project\Command\ProjectChangeNameAction;
use Commercetools\Core\Request\Project\Command\ProjectSetShippingRateInputTypeAction;
use Commercetools\Core\Request\Project\ProjectGetRequest;
use Commercetools\Core\Request\Project\ProjectUpdateRequest;

class ProjectUpdateRequestTest extends ApiTestCase
{
    public function testChangeName()
    {
        $request = ProjectGetRequest::of();
        $response = $request->executeWithClient($this->getClient());
        $project = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $project);

        $oldName = $project->getName();
        $name = $this->getTestRun() . '-new-name';

        $request = ProjectUpdateRequest::ofVersion($project->getVersion());
        $request->addAction(ProjectChangeNameAction::ofName($name));
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $result);
        $this->assertSame($name, $result->getName());

        $request = ProjectUpdateRequest::ofVersion($result->getVersion());
        $request->addAction(ProjectChangeNameAction::ofName($oldName));
        $response = $request->executeWithClient($this->getClient());

        $this->assertFalse($response->isError());
    }

    public function testChangeCurrencies()
    {
        $request = ProjectGetRequest::of();
        $response = $request->executeWithClient($this->getClient());
        $project = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $project);
        $oldCurrencies = $project->getCurrencies()->toArray();
        $currencies = array_merge($oldCurrencies, ['ZWL']);

        $request = ProjectUpdateRequest::ofVersion($project->getVersion());
        $request->addAction(ProjectChangeCurrenciesAction::ofCurrencies($currencies));
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $result);
        $this->assertContains('ZWL', $result->getCurrencies()->toArray());

        $request = ProjectUpdateRequest::ofVersion($result->getVersion());
        $request->addAction(ProjectChangeCurrenciesAction::ofCurrencies($oldCurrencies));
        $response = $request->executeWithClient($this->getClient());

        $this->assertFalse($response->isError());
    }

    public function testChangeCountries()
    {
        $request = ProjectGetRequest::of();
        $response = $request->executeWithClient($this->getClient());
        $project = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $project);
        $oldCountries = $project->getCountries()->toArray();
        $countries = array_merge($oldCountries, ['ZW']);

        $request = ProjectUpdateRequest::ofVersion($project->getVersion());
        $request->addAction(ProjectChangeCountriesAction::ofCountries($countries));
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $result);
        $this->assertContains('ZW', $result->getCountries()->toArray());

        $request = ProjectUpdateRequest::ofVersion($result->getVersion());
        $request->addAction(ProjectChangeCountriesAction::ofCountries($oldCountries));
        $response = $request->executeWithClient($this->getClient());

        $this->assertFalse($response->isError());
    }

    public function testChangeLanguages()
    {
        $request = ProjectGetRequest::of();
        $response = $request->executeWithClient($this->getClient());
        $project = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $project);
        $oldLanguages = $project->getLanguages()->toArray();
        $languages = array_merge($oldLanguages, ['zh']);

        $request = ProjectUpdateRequest::ofVersion($project->getVersion());
        $request->addAction(ProjectChangeLanguagesAction::ofLanguages($languages));
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $result);
        $this->assertContains('zh', $result->getLanguages()->toArray());

        $request = ProjectUpdateRequest::ofVersion($result->getVersion());
        $request->addAction(ProjectChangeLanguagesAction::ofLanguages($oldLanguages));
        $response = $request->executeWithClient($this->getClient());

        $this->assertFalse($response->isError());
    }

    public function testChangeMessagesEnabled()
    {
        $request = ProjectGetRequest::of();
        $response = $request->executeWithClient($this->getClient());
        $project = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $project);
        $messagesEnabled = $project->getMessages()->getEnabled();

        $request = ProjectUpdateRequest::ofVersion($project->getVersion());
        $request->addAction(ProjectChangeMessagesEnabledAction::ofMessagesEnabled(!$messagesEnabled));
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $result);
        $this->assertNotSame($messagesEnabled, $result->getMessages()->getEnabled());

        $request = ProjectUpdateRequest::ofVersion($result->getVersion());
        $request->addAction(ProjectChangeMessagesEnabledAction::ofMessagesEnabled($messagesEnabled));
        $response = $request->executeWithClient($this->getClient());

        $this->assertFalse($response->isError());
    }

    public function testChangeMessagesConfiguration()
    {
        $request = ProjectGetRequest::of();
        $response = $request->executeWithClient($this->getClient());
        $project = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $project);
        $messagesConfiguration = $project->getMessages();
        $messagesEnabled = $messagesConfiguration->getEnabled();
        $deleteDaysAfterCreation = (5 === $messagesConfiguration->getDeleteDaysAfterCreation() ?  10 : 5);

        $messagesConfigurationDraft = MessagesConfigurationDraft::of()
            ->setEnabled(!$messagesEnabled)
            ->setDeleteDaysAfterCreation($deleteDaysAfterCreation);

        $request = ProjectUpdateRequest::ofVersion($project->getVersion());
        $request->addAction(ProjectChangeMessagesConfigurationAction::ofDraft($messagesConfigurationDraft));
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $result);
        $this->assertNotSame($messagesEnabled, $result->getMessages()->getEnabled());
        $this->assertSame($deleteDaysAfterCreation, $result->getMessages()->getDeleteDaysAfterCreation());

        $request = ProjectUpdateRequest::ofVersion($result->getVersion());
        $messagesConfigurationDraft = MessagesConfigurationDraft::of()
            ->setEnabled($messagesEnabled)
            ->setDeleteDaysAfterCreation($deleteDaysAfterCreation);
        $request->addAction(ProjectChangeMessagesConfigurationAction::ofDraft($messagesConfigurationDraft));
        $response = $request->executeWithClient($this->getClient());

        $this->assertFalse($response->isError());
    }

    public function testSetShippingRateInputTypeCartValue()
    {
        $request = ProjectGetRequest::of();
        $response = $request->executeWithClient($this->getClient());
        $project = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $project);

        $request = ProjectUpdateRequest::ofVersion($project->getVersion());
        $request->addAction(
            ProjectSetShippingRateInputTypeAction::of()
                ->setShippingRateInputType(CartValueType::of())
        );
        $response = $request->executeWithClient($this->getClient());

        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $result);
        $this->assertInstanceOf(CartValueType::class, $result->getShippingRateInputType());
        $this->assertSame(CartValueType::INPUT_TYPE, $result->getShippingRateInputType()->getType());

        $request = ProjectUpdateRequest::ofVersion($result->getVersion());
        $request->addAction(ProjectSetShippingRateInputTypeAction::of());
        $response = $request->executeWithClient($this->getClient());
        $this->assertFalse($response->isError());
    }

    public function testSetShippingRateInputTypeCartScore()
    {
        $request = ProjectGetRequest::of();
        $response = $request->executeWithClient($this->getClient());
        $project = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $project);

        $request = ProjectUpdateRequest::ofVersion($project->getVersion());
        $request->addAction(
            ProjectSetShippingRateInputTypeAction::of()
                ->setShippingRateInputType(CartScoreType::of())
        );
        $response = $request->executeWithClient($this->getClient());

        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $result);
        $this->assertInstanceOf(CartScoreType::class, $result->getShippingRateInputType());
        $this->assertSame(CartScoreType::INPUT_TYPE, $result->getShippingRateInputType()->getType());

        $request = ProjectUpdateRequest::ofVersion($result->getVersion());
        $request->addAction(ProjectSetShippingRateInputTypeAction::of());
        $response = $request->executeWithClient($this->getClient());
        $this->assertFalse($response->isError());
    }

    public function testSetShippingRateInputTypeCartClassification()
    {
        $request = ProjectGetRequest::of();
        $response = $request->executeWithClient($this->getClient());
        $project = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $project);

        $request = ProjectUpdateRequest::ofVersion($project->getVersion());
        $request->addAction(
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
        $response = $request->executeWithClient($this->getClient());

        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Project::class, $result);
        $this->assertInstanceOf(CartClassificationType::class, $result->getShippingRateInputType());
        $this->assertSame(CartClassificationType::INPUT_TYPE, $result->getShippingRateInputType()->getType());
        $this->assertInstanceOf(CartClassificationType::class, $result->getShippingRateInputType());
        $this->assertCount(3, $result->getShippingRateInputType()->getValues());

        $request = ProjectUpdateRequest::ofVersion($result->getVersion());
        $request->addAction(ProjectSetShippingRateInputTypeAction::of());
        $response = $request->executeWithClient($this->getClient());
        $this->assertFalse($response->isError());
    }
}
