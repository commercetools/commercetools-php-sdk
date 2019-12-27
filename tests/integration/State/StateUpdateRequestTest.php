<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\IntegrationTests\State;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\State\State;
use Commercetools\Core\Model\State\StateDraft;
use Commercetools\Core\Model\State\StateReferenceCollection;
use Commercetools\Core\Request\States\Command\StateAddRolesAction;
use Commercetools\Core\Request\States\Command\StateChangeInitialAction;
use Commercetools\Core\Request\States\Command\StateChangeKeyAction;
use Commercetools\Core\Request\States\Command\StateChangeTypeAction;
use Commercetools\Core\Request\States\Command\StateRemoveRolesAction;
use Commercetools\Core\Request\States\Command\StateSetDescriptionAction;
use Commercetools\Core\Request\States\Command\StateSetNameAction;
use Commercetools\Core\Request\States\Command\StateSetRolesAction;
use Commercetools\Core\Request\States\Command\StateSetTransitionsAction;
use Commercetools\Core\Request\States\StateCreateRequest;
use Commercetools\Core\Request\States\StateDeleteRequest;
use Commercetools\Core\Request\States\StateUpdateRequest;

class StateUpdateRequestTest extends ApiTestCase
{
    const REVIEW_STATE = 'ReviewState';

    /**
     * @param $key
     * @return StateDraft
     */
    protected function getDraft($key)
    {
        $draft = StateDraft::ofKeyAndType(
            'test-' . $this->getTestRun() . '-' . $key,
            'ReviewState'
        )->setInitial(false);

        return $draft;
    }

    protected function createState(StateDraft $draft)
    {
        $request = StateCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $state = $request->mapResponse($response);

        $this->cleanupRequests[] = StateDeleteRequest::ofIdAndVersion(
            $state->getId(),
            $state->getVersion()
        );

        return $state;
    }

    public function testSetDescription()
    {
        $client = $this->getApiClient();

        StateFixture::withDraftState(
            $client,
            function (StateDraft $draft) {
                return $draft->setType(self::REVIEW_STATE)->setInitial(false);
            },
            function (State $state) use ($client) {
                $description = LocalizedString::ofLangAndText('en', 'new-description');
                $request = RequestBuilder::of()->states()->update($state)
                    ->addAction(StateSetDescriptionAction::ofDescription($description));

                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(State::class, $result);
                $this->assertSame($description->en, $result->getDescription()->en);
                $this->assertNotSame($state->getVersion(), $result->getVersion());
            }
        );
    }

    public function testChangeKey()
    {
        $client = $this->getApiClient();

        StateFixture::withDraftState(
            $client,
            function (StateDraft $draft) {
                return $draft->setType(self::REVIEW_STATE)->setInitial(false);
            },
            function (State $state) use ($client) {
                $key = 'new-key';
                $request = RequestBuilder::of()->states()->update($state)
                    ->addAction(StateChangeKeyAction::ofKey($key));

                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(State::class, $result);
                $this->assertSame($key, $result->getKey());
                $this->assertNotSame($state->getVersion(), $result->getVersion());
            }
        );
    }

    public function testSetStateName()
    {
        $client = $this->getApiClient();

        StateFixture::withDraftState(
            $client,
            function (StateDraft $draft) {
                return $draft->setType(self::REVIEW_STATE)->setInitial(false);
            },
            function (State $state) use ($client) {
                $name = LocalizedString::ofLangAndText('en', 'new-name');
                $request = RequestBuilder::of()->states()->update($state)
                    ->addAction(StateSetNameAction::ofName($name));

                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(State::class, $result);
                $this->assertSame($name->en, $result->getName()->en);
                $this->assertNotSame($state->getVersion(), $result->getVersion());
            }
        );
    }

    public function testChangeType()
    {
        $client = $this->getApiClient();

        StateFixture::withDraftState(
            $client,
            function (StateDraft $draft) {
                return $draft->setType(self::REVIEW_STATE)->setInitial(false);
            },
            function (State $state) use ($client) {
                $type = 'ProductState';
                $request = RequestBuilder::of()->states()->update($state)
                    ->addAction(StateChangeTypeAction::ofType($type));

                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(State::class, $result);
                $this->assertSame($type, $result->getType());
                $this->assertNotSame($state->getVersion(), $result->getVersion());
            }
        );
    }

    public function testChangeInitial()
    {
        $client = $this->getApiClient();

        StateFixture::withDraftState(
            $client,
            function (StateDraft $draft) {
                return $draft->setType(self::REVIEW_STATE)->setInitial(false);
            },
            function (State $state) use ($client) {
                $initial = true;
                $request = RequestBuilder::of()->states()->update($state)
                    ->addAction(StateChangeInitialAction::ofInitial($initial));

                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(State::class, $result);
                $this->assertSame($initial, $result->getInitial());
                $this->assertNotSame($state->getVersion(), $result->getVersion());
            }
        );
    }

    public function testSetTransition()
    {
        $client = $this->getApiClient();

        StateFixture::withDraftState(
            $client,
            function (StateDraft $draft) {
                return $draft->setKey('set-transition-1')->setType(self::REVIEW_STATE)->setInitial(false);
            },
            function (State $state) use ($client) {
            }
        );

        $draft = $this->getDraft('set-transition-1');
        $state = $this->createState($draft);

        $draft = $this->getDraft('set-transition-2');
        $request = StateCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $state2 = $request->mapResponse($response);

        $request = StateUpdateRequest::ofIdAndVersion(
            $state->getId(),
            $state->getVersion()
        )
            ->addAction(StateSetTransitionsAction::ofTransitions(
                StateReferenceCollection::of()->add($state2->getReference())
            ))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(State::class, $result);
        $this->assertSame($state2->getId(), $result->getTransitions()->current()->getId());
        $this->assertNotSame($state->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $deleteRequest = StateDeleteRequest::ofIdAndVersion(
            $state2->getId(),
            $state2->getVersion()
        );
        $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf(State::class, $result);
    }

    public function testSetRoles()
    {
        $draft = $this->getDraft('set-roles');
        $state = $this->createState($draft);


        $roles = ['ReviewIncludedInStatistics'];
        $request = StateUpdateRequest::ofIdAndVersion(
            $state->getId(),
            $state->getVersion()
        )
            ->addAction(StateSetRolesAction::ofRoles($roles))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(State::class, $result);
        $this->assertSame($roles, $result->getRoles());
        $this->assertNotSame($state->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf(State::class, $result);
    }

    public function testCreateWithRoles()
    {
        $draft = $this->getDraft('set-roles');
        $draft->setRoles(['ReviewIncludedInStatistics']);
        $state = $this->createState($draft);

        $this->assertInstanceOf(State::class, $state);
        $this->assertSame(['ReviewIncludedInStatistics'], $state->getRoles());
    }

    public function testAddRemoveRoles()
    {
        $draft = $this->getDraft('add-roles');
        $state = $this->createState($draft);


        $roles = ['ReviewIncludedInStatistics'];
        $request = StateUpdateRequest::ofIdAndVersion(
            $state->getId(),
            $state->getVersion()
        )
            ->addAction(StateAddRolesAction::ofRoles($roles))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(State::class, $result);
        $this->assertSame($roles, $result->getRoles());
        $this->assertNotSame($state->getVersion(), $result->getVersion());
        $actualVersion = $result->getVersion();

        $request = StateUpdateRequest::ofIdAndVersion(
            $state->getId(),
            $actualVersion
        )
            ->addAction(StateRemoveRolesAction::ofRoles($roles))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(State::class, $result);
        $this->assertCount(0, $result->getRoles());
        $this->assertNotSame($actualVersion, $result->getVersion());
        $actualVersion = $result->getVersion();

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($actualVersion);
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf(State::class, $result);
    }
}
