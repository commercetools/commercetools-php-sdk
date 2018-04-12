<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\Zones\Command\ZoneAddLocationAction;
use Commercetools\Core\Request\Zones\Command\ZoneChangeNameAction;
use Commercetools\Core\Request\Zones\Command\ZoneRemoveLocationAction;
use Commercetools\Core\Request\Zones\Command\ZoneSetDescriptionAction;

class ZonesActionBuilder
{
    /**
     * @link https://docs.commercetools.com/http-api-projects-zones.html#add-location
     * @param array $data
     * @return ZoneAddLocationAction
     */
    public function addLocation(array $data = [])
    {
        return ZoneAddLocationAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-zones.html#change-name
     * @param array $data
     * @return ZoneChangeNameAction
     */
    public function changeName(array $data = [])
    {
        return ZoneChangeNameAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-zones.html#remove-location
     * @param array $data
     * @return ZoneRemoveLocationAction
     */
    public function removeLocation(array $data = [])
    {
        return ZoneRemoveLocationAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-zones.html#set-description
     * @param array $data
     * @return ZoneSetDescriptionAction
     */
    public function setDescription(array $data = [])
    {
        return ZoneSetDescriptionAction::fromArray($data);
    }

    /**
     * @return ZonesActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
