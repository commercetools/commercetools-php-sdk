<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Channel;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\GeoLocation;

/**
 * @package Commercetools\Core\Model\Channel
 * @link https://dev.commercetools.com/http-api-projects-channels.html#channeldraft
 * @method string getKey()
 * @method ChannelDraft setKey(string $key = null)
 * @method array getRoles()
 * @method ChannelDraft setRoles(array $roles = null)
 * @method LocalizedString getName()
 * @method ChannelDraft setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method ChannelDraft setDescription(LocalizedString $description = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method ChannelDraft setCustom(CustomFieldObjectDraft $custom = null)
 * @method Address getAddress()
 * @method ChannelDraft setAddress(Address $address = null)
 * @method GeoLocation getGeoLocation()
 * @method ChannelDraft setGeoLocation(GeoLocation $geoLocation = null)
 */
class ChannelDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'key' => [static::TYPE => 'string'],
            'roles' => [static::TYPE => 'array'],
            'name' => [static::TYPE => LocalizedString::class],
            'description' => [static::TYPE => LocalizedString::class],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class],
            'address' => [static::TYPE => Address::class],
            'geoLocation' => [static::TYPE => GeoLocation::class],
        ];
    }

    /**
     * @param string $key
     * @param Context|callable $context
     * @return ChannelDraft
     */
    public static function ofKey($key, $context = null)
    {
        return static::of($context)->setKey($key);
    }
}
