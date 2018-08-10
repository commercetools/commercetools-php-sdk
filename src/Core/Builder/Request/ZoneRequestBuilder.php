<?php

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\Zones\ZoneByIdGetRequest;
use Commercetools\Core\Request\Zones\ZoneCreateRequest;
use Commercetools\Core\Model\Zone\ZoneDraft;
use Commercetools\Core\Request\Zones\ZoneDeleteRequest;
use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Request\Zones\ZoneQueryRequest;
use Commercetools\Core\Request\Zones\ZoneUpdateRequest;

class ZoneRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-zones.html#get-zone-by-id
     * @param string $id
     * @return ZoneByIdGetRequest
     */
    public function getById($id)
    {
        $request = ZoneByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-zones.html#create-zone
     * @param ZoneDraft $zone
     * @return ZoneCreateRequest
     */
    public function create(ZoneDraft $zone)
    {
        $request = ZoneCreateRequest::ofDraft($zone);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-zones.html#delete-zone
     * @param Zone $zone
     * @return ZoneDeleteRequest
     */
    public function delete(Zone $zone)
    {
        $request = ZoneDeleteRequest::ofIdAndVersion($zone->getId(), $zone->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-zones.html#query-zones
     * @param 
     * @return ZoneQueryRequest
     */
    public function query()
    {
        $request = ZoneQueryRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-zones.html#update-zone
     * @param Zone $zone
     * @return ZoneUpdateRequest
     */
    public function update(Zone $zone)
    {
        $request = ZoneUpdateRequest::ofIdAndVersion($zone->getId(), $zone->getVersion());
        return $request;
    }

    /**
     * @return ZoneRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
