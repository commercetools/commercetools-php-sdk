<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Zone;

use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Model\Zone
 * @link https://docs.commercetools.com/http-api-projects-zones.html#zone
 * @method string getId()
 * @method Zone setId(string $id = null)
 * @method int getVersion()
 * @method Zone setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Zone setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method Zone setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method string getName()
 * @method Zone setName(string $name = null)
 * @method string getDescription()
 * @method Zone setDescription(string $description = null)
 * @method LocationCollection getLocations()
 * @method Zone setLocations(LocationCollection $locations = null)
 * @method ZoneReference getReference()
 */
class Zone extends Resource
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
            'name' => [static::TYPE => 'string'],
            'description' => [static::TYPE => 'string'],
            'locations' => [static::TYPE => LocationCollection::class],
        ];
    }
}
