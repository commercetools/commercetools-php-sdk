<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\Zones\Command\ZoneSetDescriptionAction;
use Commercetools\Core\Request\Zones\Command\ZoneRemoveLocationAction;
use Commercetools\Core\Request\Zones\Command\ZoneChangeNameAction;
use Commercetools\Core\Request\Zones\Command\ZoneAddLocationAction;

class ZonesActionBuilder
{
    /**
     * @link https://docs.commercetools.com/http-api-projects-zones.html#set-description
     * @param array $data
     * @return ZoneSetDescriptionAction
     */
    public function setDescription(array $data = [])
    {
        return new ZoneSetDescriptionAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-zones.html#remove-location
     * @param array $data
     * @return ZoneRemoveLocationAction
     */
    public function removeLocation(array $data = [])
    {
        return new ZoneRemoveLocationAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-zones.html#change-name
     * @param array $data
     * @return ZoneChangeNameAction
     */
    public function changeName(array $data = [])
    {
        return new ZoneChangeNameAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-zones.html#add-location
     * @param array $data
     * @return ZoneAddLocationAction
     */
    public function addLocation(array $data = [])
    {
        return new ZoneAddLocationAction($data);
    }

    /**
     * @return ZonesActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
