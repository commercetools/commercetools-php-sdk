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

class StateUpdateRequestTest extends ApiTestCase
{
    const REVIEW_STATE = 'ReviewState';

    public function testSetDescription()
    {
        $client = $this->getApiClient();

        StateFixture::withUpdateableDraftState(
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

                return $result;
            }
        );
    }

    public function testChangeKey()
    {
        $client = $this->getApiClient();

        StateFixture::withUpdateableDraftState(
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
                return $result;
            }
        );
    }

    public function testSetStateName()
    {
        $client = $this->getApiClient();

        StateFixture::withUpdateableDraftState(
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

                return $result;
            }
        );
    }

    public function testChangeType()
    {
        $client = $this->getApiClient();

        StateFixture::withUpdateableDraftState(
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

                return $result;
            }
        );
    }

    public function testChangeInitial()
    {
        $client = $this->getApiClient();

        StateFixture::withUpdateableDraftState(
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

                return $result;
            }
        );
    }

    public function testSetTransition()
    {
        $client = $this->getApiClient();

        StateFixture::withDraftState(
            $client,
            function (StateDraft $state2Draft) {
                return $state2Draft->setKey('set-transition2')->setType(self::REVIEW_STATE)->setInitial(false);
            },
            function (State $state) use ($client) {
                StateFixture::withUpdateableDraftState(
                    $client,
                    function (StateDraft $state1Draft) {
                        return $state1Draft->setKey('set-transition1')->setType(self::REVIEW_STATE)->setInitial(false);
                    },
                    function (State $state1) use ($client, $state) {
                        $request = RequestBuilder::of()->states()->update($state1)
                            ->addAction(StateSetTransitionsAction::ofTransitions(
                                StateReferenceCollection::of()->add($state->getReference())
                            ));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(State::class, $result);
                        $this->assertSame($state->getId(), $result->getTransitions()->current()->getId());
                        $this->assertNotSame($state1->getVersion(), $result->getVersion());

                        return $result;
                    }
                );
            }
        );
    }

    public function testSetRoles()
    {
        $client = $this->getApiClient();

        StateFixture::withUpdateableDraftState(
            $client,
            function (StateDraft $draft) {
                return $draft->setType(self::REVIEW_STATE)->setInitial(false);
            },
            function (State $state) use ($client) {
                $roles = ['ReviewIncludedInStatistics'];
                $request = RequestBuilder::of()->states()->update($state)
                    ->addAction(StateSetRolesAction::ofRoles($roles));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(State::class, $result);
                $this->assertSame($roles, $result->getRoles());
                $this->assertNotSame($state->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testCreateWithRoles()
    {
        $client = $this->getApiClient();

        StateFixture::withDraftState(
            $client,
            function (StateDraft $draft) {
                return $draft->setType(self::REVIEW_STATE)->setInitial(false)->setRoles(['ReviewIncludedInStatistics']);
            },
            function (State $state) use ($client) {
                $this->assertInstanceOf(State::class, $state);
                $this->assertSame(['ReviewIncludedInStatistics'], $state->getRoles());
            }
        );
    }

    public function testAddRemoveRoles()
    {
        $client = $this->getApiClient();

        StateFixture::withUpdateableDraftState(
            $client,
            function (StateDraft $draft) {
                return $draft->setType(self::REVIEW_STATE)->setInitial(false);
            },
            function (State $state) use ($client) {
                $roles = ['ReviewIncludedInStatistics'];
                $request = RequestBuilder::of()->states()->update($state)
                    ->addAction(StateAddRolesAction::ofRoles($roles));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(State::class, $result);
                $this->assertSame($roles, $result->getRoles());
                $this->assertNotSame($state->getVersion(), $result->getVersion());

                $actualVersion = $result->getVersion();
                $request = RequestBuilder::of()->states()->update($result)
                    ->addAction(StateRemoveRolesAction::ofRoles($roles));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(State::class, $result);
                $this->assertCount(0, $result->getRoles());
                $this->assertNotSame($actualVersion, $result->getVersion());

                return $result;
            }
        );
    }
}
