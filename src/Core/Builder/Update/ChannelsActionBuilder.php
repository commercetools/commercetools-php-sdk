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
     * @link https://docs.commercetools.com/http-api-projects-channels.html#set-address
     * @param array $data
     * @return ChannelSetAddressAction
     */
    public function setAddress(array $data = [])
    {
        return new ChannelSetAddressAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-channels.html#change-description
     * @param array $data
     * @return ChannelChangeDescriptionAction
     */
    public function changeDescription(array $data = [])
    {
        return new ChannelChangeDescriptionAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-channels.html#change-name
     * @param array $data
     * @return ChannelChangeNameAction
     */
    public function changeName(array $data = [])
    {
        return new ChannelChangeNameAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-channels.html#set-geolocation
     * @param array $data
     * @return ChannelSetGeoLocation
     */
    public function setGeoLocation(array $data = [])
    {
        return new ChannelSetGeoLocation($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-channels.html#set-roles
     * @param array $data
     * @return ChannelSetRolesAction
     */
    public function setRoles(array $data = [])
    {
        return new ChannelSetRolesAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-channels.html#remove-roles
     * @param array $data
     * @return ChannelRemoveRolesAction
     */
    public function removeRoles(array $data = [])
    {
        return new ChannelRemoveRolesAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-channels.html#add-roles
     * @param array $data
     * @return ChannelAddRolesAction
     */
    public function addRoles(array $data = [])
    {
        return new ChannelAddRolesAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-channels.html#change-key
     * @param array $data
     * @return ChannelChangeKeyAction
     */
    public function changeKey(array $data = [])
    {
        return new ChannelChangeKeyAction($data);
    }

    /**
     * @return ChannelsActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
