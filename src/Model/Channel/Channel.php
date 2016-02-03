<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Channel;

use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\Review\ReviewRatingStatistics;

/**
 * @package Commercetools\Core\Model\Channel
 * @apidoc http://dev.sphere.io/http-api-projects-channels.html#channel
 * @method string getId()
 * @method Channel setId(string $id = null)
 * @method int getVersion()
 * @method Channel setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Channel setCreatedAt(\DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method Channel setLastModifiedAt(\DateTime $lastModifiedAt = null)
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
 */
class Channel extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'lastModifiedAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'key' => [static::TYPE => 'string'],
            'roles' => [static::TYPE => 'array'],
            'name' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'description' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'reviewRatingStatistics' => [static::TYPE => '\Commercetools\Core\Model\Review\ReviewRatingStatistics'],
            'custom' => [static::TYPE => '\Commercetools\Core\Model\CustomField\CustomFieldObject'],
        ];
    }
}
