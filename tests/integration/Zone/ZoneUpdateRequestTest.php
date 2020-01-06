<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Zone;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Zone\Location;
use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Model\Zone\ZoneDraft;
use Commercetools\Core\Request\Zones\Command\ZoneAddLocationAction;
use Commercetools\Core\Request\Zones\Command\ZoneChangeNameAction;
use Commercetools\Core\Request\Zones\Command\ZoneRemoveLocationAction;
use Commercetools\Core\Request\Zones\Command\ZoneSetDescriptionAction;
use Commercetools\Core\Request\Zones\Command\ZoneSetKeyAction;

class ZoneUpdateRequestTest extends ApiTestCase
{
    public function testSetDescription()
    {
        $client = $this->getApiClient();

        ZoneFixture::withUpdateableDraftZone(
            $client,
            function (ZoneDraft $draft) {
                return $draft->setDescription('set-description');
            },
            function (Zone $zone) use ($client) {
                $description = 'new-description' . ZoneFixture::uniqueZoneString();

                $request = RequestBuilder::of()->zones()->update($zone)
                    ->addAction(ZoneSetDescriptionAction::of()->setDescription($description));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Zone::class, $result);
                $this->assertSame($description, $result->getDescription());
                $this->assertNotSame($zone->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testChangeName()
    {
        $client = $this->getApiClient();

        ZoneFixture::withUpdateableDraftZone(
            $client,
            function (ZoneDraft $draft) {
                return $draft->setName('change-name');
            },
            function (Zone $zone) use ($client) {
                $name = 'new-name' . ZoneFixture::uniqueZoneString();

                $request = RequestBuilder::of()->zones()->update($zone)
                    ->addAction(ZoneChangeNameAction::ofName($name));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Zone::class, $result);
                $this->assertSame($name, $result->getName());
                $this->assertNotSame($zone->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testAddRemoveLocation()
    {
        $client = $this->getApiClient();

        ZoneFixture::withUpdateableZone(
            $client,
            function (Zone $zone) use ($client) {
                $location = Location::of()->setCountry('DE')->setState('new-' . $this->getRegion());

                $request = RequestBuilder::of()->zones()->update($zone)
                    ->addAction(ZoneAddLocationAction::ofLocation($location));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Zone::class, $result);
                $this->assertCount(2, $result->getLocations());
                $this->assertNotSame($zone->getVersion(), $result->getVersion());

                $request = RequestBuilder::of()->zones()->update($result)
                    ->addAction(ZoneRemoveLocationAction::ofLocation($location));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Zone::class, $result);
                $this->assertCount(1, $result->getLocations());
                $this->assertNotSame($zone->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testUpdateByKey()
    {
        $client = $this->getApiClient();

        ZoneFixture::withUpdateableZone(
            $client,
            function (Zone $zone) use ($client) {
                $key = 'new-key' . ZoneFixture::uniqueZoneString();

                $request = RequestBuilder::of()->zones()->update($zone)
                    ->addAction(ZoneSetKeyAction::ofKey($key));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Zone::class, $result);
                $this->assertSame($key, $result->getKey());
                $this->assertNotSame($zone->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }
}
