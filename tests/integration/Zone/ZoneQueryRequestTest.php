<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Zone;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Fixtures\FixtureException;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Zone\Zone;

class ZoneQueryRequestTest extends ApiTestCase
{
    public function testQuery()
    {
        $client = $this->getApiClient();

        ZoneFixture::withZone(
            $client,
            function (Zone $zone) use ($client) {
                $request = RequestBuilder::of()->zones()->query()
                    ->where('name=:name', ['name' => $zone->getName()]);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(Zone::class, $result->current());
                $this->assertSame($zone->getId(), $result->current()->getId());
            }
        );
    }

    public function testGetById()
    {
        $client = $this->getApiClient();

        ZoneFixture::withZone(
            $client,
            function (Zone $zone) use ($client) {
                $request = RequestBuilder::of()->zones()->getById($zone->getId());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Zone::class, $zone);
                $this->assertSame($zone->getId(), $result->getId());
            }
        );
    }

    public function testGetByKey()
    {
        $client = $this->getApiClient();

        ZoneFixture::withZone(
            $client,
            function (Zone $zone) use ($client) {
                $request = RequestBuilder::of()->zones()->getByKey($zone->getKey());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Zone::class, $zone);
                $this->assertSame($zone->getId(), $result->getId());
                $this->assertSame($zone->getKey(), $result->getKey());
            }
        );
    }

    public function testDeleteByKey()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(404);

        $client = $this->getApiClient();

        ZoneFixture::withZone(
            $client,
            function (Zone $zone) use ($client) {
                $request = RequestBuilder::of()->zones()->deleteByKey($zone);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($zone->getId(), $result->getId());
                $this->assertInstanceOf(Zone::class, $result);

                $request = RequestBuilder::of()->zones()->getByKey($result->getKey());
                $response = $this->execute($client, $request);
                $request->mapFromResponse($response);
            }
        );
    }
}
