<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Model\Zone\ZoneDraft;
use Commercetools\Core\Request\Zones\ZoneByIdGetRequest;
use Commercetools\Core\Request\Zones\ZoneCreateRequest;
use Commercetools\Core\Request\Zones\ZoneDeleteRequest;
use Commercetools\Core\Request\Zones\ZoneQueryRequest;
use Commercetools\Core\Request\Zones\ZoneUpdateRequest;

class ZoneRequestBuilder
{
    /**
     * @return ZoneQueryRequest
     */
    public function query()
    {
        return ZoneQueryRequest::of();
    }

    /**
     * @param Zone $zone
     * @return ZoneUpdateRequest
     */
    public function update(Zone $zone)
    {
        return ZoneUpdateRequest::ofIdAndVersion($zone->getId(), $zone->getVersion());
    }

    /**
     * @param ZoneDraft $zoneDraft
     * @return ZoneCreateRequest
     */
    public function create(ZoneDraft $zoneDraft)
    {
        return ZoneCreateRequest::ofDraft($zoneDraft);
    }

    /**
     * @param Zone $zone
     * @return ZoneDeleteRequest
     */
    public function delete(Zone $zone)
    {
        return ZoneDeleteRequest::ofIdAndVersion($zone->getId(), $zone->getVersion());
    }

    /**
     * @param $id
     * @return ZoneByIdGetRequest
     */
    public function getById($id)
    {
        return ZoneByIdGetRequest::ofId($id);
    }
}
