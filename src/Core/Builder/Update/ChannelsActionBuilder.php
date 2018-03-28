<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\Channels\Command\ChannelSetAddressAction;
use Commercetools\Core\Request\Channels\Command\ChannelChangeDescriptionAction;
use Commercetools\Core\Request\Channels\Command\ChannelChangeNameAction;
use Commercetools\Core\Request\Channels\Command\ChannelSetGeoLocation;
use Commercetools\Core\Request\Channels\Command\ChannelSetRolesAction;
use Commercetools\Core\Request\Channels\Command\ChannelRemoveRolesAction;
use Commercetools\Core\Request\Channels\Command\ChannelAddRolesAction;
use Commercetools\Core\Request\Channels\Command\ChannelChangeKeyAction;

class ChannelsActionBuilder
{
    /**
     * @return ChannelSetAddressAction
     */
    public function setAddress()
    {
        return ChannelSetAddressAction::of();
    }

    /**
     * @return ChannelChangeDescriptionAction
     */
    public function changeDescription()
    {
        return ChannelChangeDescriptionAction::of();
    }

    /**
     * @return ChannelChangeNameAction
     */
    public function changeName()
    {
        return ChannelChangeNameAction::of();
    }

    /**
     * @return ChannelSetGeoLocation
     */
    public function setGeoLocation()
    {
        return ChannelSetGeoLocation::of();
    }

    /**
     * @return ChannelSetRolesAction
     */
    public function setRoles()
    {
        return ChannelSetRolesAction::of();
    }

    /**
     * @return ChannelRemoveRolesAction
     */
    public function removeRoles()
    {
        return ChannelRemoveRolesAction::of();
    }

    /**
     * @return ChannelAddRolesAction
     */
    public function addRoles()
    {
        return ChannelAddRolesAction::of();
    }

    /**
     * @return ChannelChangeKeyAction
     */
    public function changeKey()
    {
        return ChannelChangeKeyAction::of();
    }
}
