<?php

namespace Commercetools\Core\Error;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Channel\ChannelRole;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method MissingRoleOnChannelError setCode(string $code = null)
 * @method string getMessage()
 * @method MissingRoleOnChannelError setMessage(string $message = null)
 * @method ChannelReference getChannel()
 * @method MissingRoleOnChannelError setChannel(ChannelReference $channel = null)
 * @method ChannelRole getMissingRole()
 * @method MissingRoleOnChannelError setMissingRole(ChannelRole $missingRole = null)
 */
class MissingRoleOnChannelError extends ApiError
{
    const CODE = 'MissingRoleOnChannel';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['channel'] = [static::TYPE => ChannelReference::class];
        $definitions['missingRole'] = [static::TYPE => ChannelRole::class];

        return $definitions;
    }
}
