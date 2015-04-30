<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Zone;

use Sphere\Core\Model\Common\Document;

/**
 * Class Zone
 * @package Sphere\Core\Model\Zone
 * @link http://dev.sphere.io/http-api-projects-zones.html#zone
 * @method string getId()
 * @method Zone setId(string $id = null)
 * @method int getVersion()
 * @method Zone setVersion(int $version = null)
 * @method \DateTime getCreatedAt()
 * @method Zone setCreatedAt(\DateTime $createdAt = null)
 * @method \DateTime getLastModifiedAt()
 * @method Zone setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method string getName()
 * @method Zone setName(string $name = null)
 * @method string getDescription()
 * @method Zone setDescription(string $description = null)
 * @method LocationCollection getLocations()
 * @method Zone setLocations(LocationCollection $locations = null)
 */
class Zone extends Document
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [static::TYPE => '\DateTime'],
            'lastModifiedAt' => [static::TYPE => '\DateTime'],
            'name' => [static::TYPE => 'string'],
            'description' => [static::TYPE => 'string'],
            'locations' => [static::TYPE => '\Sphere\Core\Model\Zone\LocationCollection'],
        ];
    }
}
