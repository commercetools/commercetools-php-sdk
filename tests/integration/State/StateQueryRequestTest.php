<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\State;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\State\State;

class StateQueryRequestTest extends ApiTestCase
{
    const PRODUCT_STATE = 'ProductState';

    public function testQuery()
    {
        $client = $this->getApiClient();

        StateFixture::withState(
            $client,
            function (State $state) use ($client) {
                $request = RequestBuilder::of()->states()->query()
                    ->where('key=:key', ['key' => $state->getKey()]);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(State::class, $result->current());
                $this->assertSame($state->getId(), $result->current()->getId());
            }
        );
    }

    public function testGetById()
    {
        $client = $this->getApiClient();

        StateFixture::withState(
            $client,
            function (State $state) use ($client) {
                $request = RequestBuilder::of()->states()->getById($state->getId());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(State::class, $result);
                $this->assertSame($state->getId(), $result->getId());
            }
        );
    }
}
