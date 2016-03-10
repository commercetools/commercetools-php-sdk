<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Zone;


use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Zone\Location;
use Commercetools\Core\Model\Zone\LocationCollection;
use Commercetools\Core\Model\Zone\ZoneDraft;
use Commercetools\Core\Request\Zones\Command\ZoneAddLocationAction;
use Commercetools\Core\Request\Zones\Command\ZoneChangeNameAction;
use Commercetools\Core\Request\Zones\Command\ZoneRemoveLocationAction;
use Commercetools\Core\Request\Zones\Command\ZoneSetDescriptionAction;
use Commercetools\Core\Request\Zones\ZoneCreateRequest;
use Commercetools\Core\Request\Zones\ZoneDeleteRequest;
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

        $this->cleanupRequests[] = ZoneDeleteRequest::ofIdAndVersion(
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

        $this->assertInstanceOf('\Commercetools\Core\Model\Zone\Zone', $result);
        $this->assertSame($description, $result->getDescription());
        $this->assertNotSame($zone->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Zone\Zone', $result);
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

        $this->assertInstanceOf('\Commercetools\Core\Model\Zone\Zone', $result);
        $this->assertSame($name, $result->getName());
        $this->assertNotSame($zone->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Zone\Zone', $result);
    }

    public function testAddRemoveLocation()
    {
        $draft = $this->getDraft('add-location');
        $zone = $this->createZone($draft);

        $location = Location::of()->setCountry('DE')->setState('new-' . $this->getState());
        $request = ZoneUpdateRequest::ofIdAndVersion(
            $zone->getId(),
            $zone->getVersion()
        )
            ->addAction(ZoneAddLocationAction::ofLocation($location))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Zone\Zone', $result);
        $this->assertCount(2, $result->getLocations());
        $this->assertNotSame($zone->getVersion(), $result->getVersion());
        $actualVersion = $result->getVersion();

        $request = ZoneUpdateRequest::ofIdAndVersion(
            $zone->getId(),
            $actualVersion
        )
            ->addAction(ZoneRemoveLocationAction::ofLocation($location))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Zone\Zone', $result);
        $this->assertCount(1, $result->getLocations());
        $this->assertNotSame($actualVersion, $result->getVersion());
        $actualVersion = $result->getVersion();

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($actualVersion);
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Zone\Zone', $result);
    }
}
