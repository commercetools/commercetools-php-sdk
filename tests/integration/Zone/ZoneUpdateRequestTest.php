<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\IntegrationTests\Zone;

use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Zone\Location;
use Commercetools\Core\Model\Zone\LocationCollection;
use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Model\Zone\ZoneDraft;
use Commercetools\Core\Request\Zones\Command\ZoneAddLocationAction;
use Commercetools\Core\Request\Zones\Command\ZoneChangeNameAction;
use Commercetools\Core\Request\Zones\Command\ZoneRemoveLocationAction;
use Commercetools\Core\Request\Zones\Command\ZoneSetDescriptionAction;
use Commercetools\Core\Request\Zones\Command\ZoneSetKeyAction;
use Commercetools\Core\Request\Zones\ZoneCreateRequest;
use Commercetools\Core\Request\Zones\ZoneDeleteRequest;
use Commercetools\Core\Request\Zones\ZoneUpdateByKeyRequest;
use Commercetools\Core\Request\Zones\ZoneUpdateRequest;

class ZoneUpdateRequestTest extends ApiTestCase
{
    /**
     * @return ZoneDraft
     */
    protected function getDraft($name)
    {
        $draft = ZoneDraft::ofNameAndLocations(
            'test-' . $this->getTestRun() . '-' . $name,
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

        $this->cleanupRequests[] = $this->deleteRequest = ZoneDeleteRequest::ofIdAndVersion(
            $zone->getId(),
            $zone->getVersion()
        );

        return $zone;
    }

    public function testSetDescription()
    {
        $draft = $this->getDraft('set-description');
        $zone = $this->createZone($draft);


        $description = $this->getTestRun() . '-new-description';
        $request = ZoneUpdateRequest::ofIdAndVersion(
            $zone->getId(),
            $zone->getVersion()
        )
            ->addAction(ZoneSetDescriptionAction::of()->setDescription($description))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Zone::class, $result);
        $this->assertSame($description, $result->getDescription());
        $this->assertNotSame($zone->getVersion(), $result->getVersion());
    }

    public function testChangeName()
    {
        $draft = $this->getDraft('change-name');
        $zone = $this->createZone($draft);


        $name = $this->getTestRun() . '-new-name';
        $request = ZoneUpdateRequest::ofIdAndVersion(
            $zone->getId(),
            $zone->getVersion()
        )
            ->addAction(ZoneChangeNameAction::ofName($name))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Zone::class, $result);
        $this->assertSame($name, $result->getName());
        $this->assertNotSame($zone->getVersion(), $result->getVersion());
    }

    public function testAddRemoveLocation()
    {
        $draft = $this->getDraft('add-location');
        $zone = $this->createZone($draft);

        $location = Location::of()->setCountry('DE')->setState('new-' . $this->getRegion());
        $request = ZoneUpdateRequest::ofIdAndVersion(
            $zone->getId(),
            $zone->getVersion()
        )
            ->addAction(ZoneAddLocationAction::ofLocation($location))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Zone::class, $result);
        $this->assertCount(2, $result->getLocations());
        $this->assertNotSame($zone->getVersion(), $result->getVersion());
        $zone = $result;

        $request = ZoneUpdateRequest::ofIdAndVersion(
            $zone->getId(),
            $zone->getVersion()
        )
            ->addAction(ZoneRemoveLocationAction::ofLocation($location))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Zone::class, $result);
        $this->assertCount(1, $result->getLocations());
        $this->assertNotSame($zone->getVersion(), $result->getVersion());
    }

    public function testUpdateByKey()
    {
        $draft = $this->getDraft('change-key')->setKey($this->getTestRun() . '-key');
        $zone = $this->createZone($draft);

        $key = $this->getTestRun() . '-new-key';
        $request = ZoneUpdateByKeyRequest::ofKeyAndVersion(
            $zone->getKey(),
            $zone->getVersion()
        )
            ->addAction(ZoneSetKeyAction::ofKey($key))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Zone::class, $result);
        $this->assertSame($key, $result->getKey());
        $this->assertNotSame($zone->getVersion(), $result->getVersion());
    }
}
