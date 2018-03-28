<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\Zones\Command\ZoneSetDescriptionAction;
use Commercetools\Core\Request\Zones\Command\ZoneRemoveLocationAction;
use Commercetools\Core\Request\Zones\Command\ZoneChangeNameAction;
use Commercetools\Core\Request\Zones\Command\ZoneAddLocationAction;

class ZonesActionBuilder
{
    /**
     * @return ZoneSetDescriptionAction
     */
    public function setDescription()
    {
        return ZoneSetDescriptionAction::of();
    }

    /**
     * @return ZoneRemoveLocationAction
     */
    public function removeLocation()
    {
        return ZoneRemoveLocationAction::of();
    }

    /**
     * @return ZoneChangeNameAction
     */
    public function changeName()
    {
        return ZoneChangeNameAction::of();
    }

    /**
     * @return ZoneAddLocationAction
     */
    public function addLocation()
    {
        return ZoneAddLocationAction::of();
    }
}
