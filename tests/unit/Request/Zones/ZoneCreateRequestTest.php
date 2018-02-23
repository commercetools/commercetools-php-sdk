<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Zones;

use Commercetools\Core\Model\Zone\Location;
use Commercetools\Core\Model\Zone\LocationCollection;
use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Model\Zone\ZoneDraft;
use Commercetools\Core\RequestTestCase;

/**
 * Class ZoneCreateRequestTest
 * @package Commercetools\Core\Request\Zones
 */
class ZoneCreateRequestTest extends RequestTestCase
{
    const ZONE_CREATE_REQUEST = ZoneCreateRequest::class;

    protected function getZoneDraft()
    {
        return ZoneDraft::fromArray([
            "name"=> "myZone",
            "description"=> "Zone 1",
            "locations"=> [
                "country"=> "DE",
                "state"=> "Berlin"
            ]
        ]);
    }
    public function testMapResult()
    {
        $result = $this->mapResult(ZoneCreateRequest::ofDraft($this->getZoneDraft()));
        $this->assertInstanceOf(Zone::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ZoneCreateRequest::ofDraft($this->getZoneDraft()));
        $this->assertNull($result);
    }
}
