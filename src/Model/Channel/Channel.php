<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Channel;

use Sphere\Core\Model\Common\Resource;
use Sphere\Core\Model\Common\LocalizedString;

/**
 * @package Sphere\Core\Model\Channel
 * @link http://dev.sphere.io/http-api-projects-channels.html#channel
 * @method string getId()
 * @method Channel setId(string $id = null)
 * @method int getVersion()
 * @method Channel setVersion(int $version = null)
 * @method \DateTime getCreatedAt()
 * @method Channel setCreatedAt(\DateTime $createdAt = null)
 * @method \DateTime getLastModifiedAt()
 * @method Channel setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method string getKey()
 * @method Channel setKey(string $key = null)
 * @method array getRoles()
 * @method Channel setRoles(array $roles = null)
 * @method LocalizedString getName()
 * @method Channel setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method Channel setDescription(LocalizedString $description = null)
 */
class Channel extends Resource
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [static::TYPE => '\DateTime'],
            'lastModifiedAt' => [static::TYPE => '\DateTime'],
            'key' => [static::TYPE => 'string'],
            'roles' => [static::TYPE => 'array'],
            'name' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'description' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString']
        ];
    }
}
