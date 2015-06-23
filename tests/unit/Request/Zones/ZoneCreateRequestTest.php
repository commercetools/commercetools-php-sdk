<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Zones;


use Sphere\Core\Model\Zone\Location;
use Sphere\Core\Model\Zone\LocationCollection;
use Sphere\Core\Model\Zone\ZoneDraft;
use Sphere\Core\RequestTestCase;

/**
 * Class ZoneCreateRequestTest
 * @package Sphere\Core\Request\Zones
 */
class ZoneCreateRequestTest extends RequestTestCase
{
    const ZONE_CREATE_REQUEST = '\Sphere\Core\Request\Zones\ZoneCreateRequest';

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
        $this->assertInstanceOf('\Sphere\Core\Model\Zone\Zone', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ZoneCreateRequest::ofDraft($this->getZoneDraft()));
        $this->assertNull($result);
    }
}
