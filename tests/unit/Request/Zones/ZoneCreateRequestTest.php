<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Zones;

use Commercetools\Core\Model\Zone\Location;
use Commercetools\Core\Model\Zone\LocationCollection;
use Commercetools\Core\Model\Zone\ZoneDraft;
use Commercetools\Core\RequestTestCase;

/**
 * Class ZoneCreateRequestTest
 * @package Commercetools\Core\Request\Zones
 */
class ZoneCreateRequestTest extends RequestTestCase
{
    const ZONE_CREATE_REQUEST = '\Commercetools\Core\Request\Zones\ZoneCreateRequest';

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
        $this->assertInstanceOf('\Commercetools\Core\Model\Zone\Zone', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ZoneCreateRequest::ofDraft($this->getZoneDraft()));
        $this->assertNull($result);
    }
}
