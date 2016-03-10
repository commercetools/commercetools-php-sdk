<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Zone;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Zone\ZoneDraft;
use Commercetools\Core\Model\Zone\Location;
use Commercetools\Core\Model\Zone\LocationCollection;
use Commercetools\Core\Request\Zones\ZoneByIdGetRequest;
use Commercetools\Core\Request\Zones\ZoneCreateRequest;
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
        $this->assertInstanceOf('\Commercetools\Core\Model\Zone\Zone', $result->getAt(0));
        $this->assertSame($zone->getId(), $result->getAt(0)->getId());
    }

    public function testGetById()
    {
        $draft = $this->getDraft();
        $zone = $this->createZone($draft);

        $request = ZoneByIdGetRequest::ofId($zone->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Zone\Zone', $zone);
        $this->assertSame($zone->getId(), $result->getId());

    }
}
