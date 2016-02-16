<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
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

    public function testQueryByName()
    {
        $draft = $this->getDraft();
        $state = $this->createState($draft);

        $result = $this->getClient()->execute(
            StateQueryRequest::of()->where('key="' . $draft->getKey() . '"')
        )->toObject();

        $this->assertCount(1, $result);
        $this->assertInstanceOf('\Commercetools\Core\Model\State\State', $result->getAt(0));
        $this->assertSame($state->getId(), $result->getAt(0)->getId());
    }

    public function testQueryById()
    {
        $draft = $this->getDraft();
        $state = $this->createState($draft);

        $result = $this->getClient()->execute(StateByIdGetRequest::ofId($state->getId()))->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\State\State', $state);
        $this->assertSame($state->getId(), $result->getId());

    }
}
