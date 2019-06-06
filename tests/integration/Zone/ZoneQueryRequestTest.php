<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\IntegrationTests\Zone;

use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Model\Zone\ZoneDraft;
use Commercetools\Core\Model\Zone\Location;
use Commercetools\Core\Model\Zone\LocationCollection;
use Commercetools\Core\Request\Zones\ZoneByIdGetRequest;
use Commercetools\Core\Request\Zones\ZoneByKeyGetRequest;
use Commercetools\Core\Request\Zones\ZoneCreateRequest;
use Commercetools\Core\Request\Zones\ZoneDeleteByKeyRequest;
use Commercetools\Core\Request\Zones\ZoneDeleteRequest;
use Commercetools\Core\Request\Zones\ZoneQueryRequest;

class ZoneQueryRequestTest extends ApiTestCase
{
    /**
     * @return ZoneDraft
     */
    protected function getDraft()
    {
        $draft = ZoneDraft::ofNameAndLocations(
            'test-' . $this->getTestRun() . '-name',
            LocationCollection::of()->add(
                Location::of()->setCountry('DE')->setState($this->getRegion())
            )
        );

        return $draft;
    }

    protected function createZone(ZoneDraft $draft)
    {
        $request = ZoneCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $zone = $request->mapResponse($response);

        $this->cleanupRequests[] = ZoneDeleteRequest::ofIdAndVersion(
            $zone->getId(),
            $zone->getVersion()
        );

        return $zone;
    }

    public function testQuery()
    {
        $draft = $this->getDraft();
        $zone = $this->createZone($draft);

        $request = ZoneQueryRequest::of()->where('name="' . $draft->getName() . '"');
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(Zone::class, $result->getAt(0));
        $this->assertSame($zone->getId(), $result->getAt(0)->getId());
    }

    public function testGetById()
    {
        $draft = $this->getDraft();
        $zone = $this->createZone($draft);

        $request = ZoneByIdGetRequest::ofId($zone->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Zone::class, $zone);
        $this->assertSame($zone->getId(), $result->getId());
    }

    public function testGetByKey()
    {
        $draft = $this->getDraft()->setKey('key-' . $this->getTestRun());
        $zone = $this->createZone($draft);

        $request = ZoneByKeyGetRequest::ofKey($zone->getKey());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Zone::class, $zone);
        $this->assertSame($zone->getKey(), $result->getKey());
    }

    public function testDeleteByKey()
    {
        $draft = $this->getDraft()->setKey('key-' . $this->getTestRun());
        $zone = $this->createZone($draft);

        $request = ZoneDeleteByKeyRequest::ofKeyAndVersion(
            $zone->getKey(),
            $zone->getVersion()
        );
        $result = $this->getClient()->execute($request);
        $response = $request->mapFromResponse($result);

        $this->assertSame($zone->getId(), $response->getId());
    }
}
