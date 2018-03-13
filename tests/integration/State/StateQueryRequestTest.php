<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\State;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\State\State;
use Commercetools\Core\Model\State\StateDraft;
use Commercetools\Core\Request\States\StateByIdGetRequest;
use Commercetools\Core\Request\States\StateCreateRequest;
use Commercetools\Core\Request\States\StateDeleteRequest;
use Commercetools\Core\Request\States\StateQueryRequest;

class StateQueryRequestTest extends ApiTestCase
{
    /**
     * @return StateDraft
     */
    protected function getDraft()
    {
        $draft = StateDraft::ofKeyAndType(
            'test-' . $this->getTestRun() . '-key',
            'ProductState'
        );

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

    public function testQuery()
    {
        $draft = $this->getDraft();
        $state = $this->createState($draft);

        $request = StateQueryRequest::of()->where('key="' . $draft->getKey() . '"');
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(State::class, $result->getAt(0));
        $this->assertSame($state->getId(), $result->getAt(0)->getId());
    }

    public function testGetById()
    {
        $draft = $this->getDraft();
        $state = $this->createState($draft);

        $request = StateByIdGetRequest::ofId($state->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(State::class, $state);
        $this->assertSame($state->getId(), $result->getId());

    }
}
