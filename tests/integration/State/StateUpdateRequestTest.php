<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\State;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Common\LocalizedString;
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
        $draft = $this->getDraft('set-description');
        $state = $this->createState($draft);


        $description = LocalizedString::ofLangAndText('en', $this->getTestRun() . '-new-description');
        $request = StateUpdateRequest::ofIdAndVersion(
            $state->getId(),
            $state->getVersion()
        )
            ->addAction(StateSetDescriptionAction::ofDescription($description))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\State\State', $result);
        $this->assertSame($description->en, $result->getDescription()->en);
        $this->assertNotSame($state->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\State\State', $result);
    }

    public function testChangeKey()
    {
        $draft = $this->getDraft('change-key');
        $state = $this->createState($draft);


        $key = $this->getTestRun() . '-new-key';
        $request = StateUpdateRequest::ofIdAndVersion(
            $state->getId(),
            $state->getVersion()
        )
            ->addAction(StateChangeKeyAction::ofKey($key))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\State\State', $result);
        $this->assertSame($key, $result->getKey());
        $this->assertNotSame($state->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\State\State', $result);
    }

    public function testSetStateName()
    {
        $draft = $this->getDraft('set-name');
        $state = $this->createState($draft);


        $name = LocalizedString::ofLangAndText('en', $this->getTestRun() . '-new-name');
        $request = StateUpdateRequest::ofIdAndVersion(
            $state->getId(),
            $state->getVersion()
        )
            ->addAction(StateSetNameAction::ofName($name))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\State\State', $result);
        $this->assertSame($name->en, $result->getName()->en);
        $this->assertNotSame($state->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\State\State', $result);
    }

    public function testChangeType()
    {
        $draft = $this->getDraft('change-type');
        $state = $this->createState($draft);


        $type = 'ProductState';
        $request = StateUpdateRequest::ofIdAndVersion(
            $state->getId(),
            $state->getVersion()
        )
            ->addAction(StateChangeTypeAction::ofType($type))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\State\State', $result);
        $this->assertSame($type, $result->getType());
        $this->assertNotSame($state->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\State\State', $result);
    }

    public function testChangeInitial()
    {
        $draft = $this->getDraft('change-initial');
        $state = $this->createState($draft);


        $initial = true;
        $request = StateUpdateRequest::ofIdAndVersion(
            $state->getId(),
            $state->getVersion()
        )
            ->addAction(StateChangeInitialAction::ofInitial($initial))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\State\State', $result);
        $this->assertSame($initial, $result->getInitial());
        $this->assertNotSame($state->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\State\State', $result);
    }

    public function testSetTransition()
    {
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

        $this->assertInstanceOf('\Commercetools\Core\Model\State\State', $result);
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

        $this->assertInstanceOf('\Commercetools\Core\Model\State\State', $result);
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

        $this->assertInstanceOf('\Commercetools\Core\Model\State\State', $result);
        $this->assertSame($roles, $result->getRoles());
        $this->assertNotSame($state->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\State\State', $result);
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

        $this->assertInstanceOf('\Commercetools\Core\Model\State\State', $result);
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

        $this->assertInstanceOf('\Commercetools\Core\Model\State\State', $result);
        $this->assertCount(0, $result->getRoles());
        $this->assertNotSame($actualVersion, $result->getVersion());
        $actualVersion = $result->getVersion();

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($actualVersion);
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\State\State', $result);
    }
}
