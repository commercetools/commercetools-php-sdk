<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Channel;

use Commercetools\Core\Model\Common\CreatedBy;
use Commercetools\Core\Model\Common\LastModifiedBy;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\Review\ReviewRatingStatistics;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\GeoLocation;
use DateTime;

/**
 * @package Commercetools\Core\Model\Channel
 * @link https://docs.commercetools.com/http-api-projects-channels.html#channel
 * @method string getId()
 * @method Channel setId(string $id = null)
 * @method int getVersion()
 * @method Channel setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Channel setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method Channel setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method string getKey()
 * @method Channel setKey(string $key = null)
 * @method array getRoles()
 * @method Channel setRoles(array $roles = null)
 * @method LocalizedString getName()
 * @method Channel setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method Channel setDescription(LocalizedString $description = null)
 * @method CustomFieldObject getCustom()
 * @method Channel setCustom(CustomFieldObject $custom = null)
 * @method ReviewRatingStatistics getReviewRatingStatistics()
 * @method Channel setReviewRatingStatistics(ReviewRatingStatistics $reviewRatingStatistics = null)
 * @method Address getAddress()
 * @method Channel setAddress(Address $address = null)
 * @method GeoLocation getGeoLocation()
 * @method Channel setGeoLocation(GeoLocation $geoLocation = null)
 * @method CreatedBy getCreatedBy()
 * @method Channel setCreatedBy(CreatedBy $createdBy = null)
 * @method LastModifiedBy getLastModifiedBy()
 * @method Channel setLastModifiedBy(LastModifiedBy $lastModifiedBy = null)
 * @method ChannelReference getReference()
 */
class Channel extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'key' => [static::TYPE => 'string'],
            'roles' => [static::TYPE => 'array'],
            'name' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'description' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'reviewRatingStatistics' => [static::TYPE => ReviewRatingStatistics::class, static::OPTIONAL => true],
            'custom' => [static::TYPE => CustomFieldObject::class, static::OPTIONAL => true],
            'address' => [static::TYPE => Address::class, static::OPTIONAL => true],
            'geoLocation' => [static::TYPE => GeoLocation::class, static::OPTIONAL => true],
            'createdBy' => [static::TYPE => CreatedBy::class, static::OPTIONAL => true],
            'lastModifiedBy' => [static::TYPE => LastModifiedBy::class, static::OPTIONAL => true],
        ];
    }
}
