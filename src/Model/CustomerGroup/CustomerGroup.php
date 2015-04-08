<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\CustomerGroup;

use Sphere\Core\Model\Common\JsonObject;

/**
 * Class CustomerGroup
 * @package Sphere\Core\Model\CustomerGroup
 * @method string getId()
 * @method CustomerGroup setId(string $id = null)
 * @method int getVersion()
 * @method CustomerGroup setVersion(int $version = null)
 * @method \DateTime getCreatedAt()
 * @method CustomerGroup setCreatedAt(\DateTime $createdAt = null)
 * @method \DateTime getLastModifiedAt()
 * @method CustomerGroup setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method string getName()
 * @method CustomerGroup setName(string $name = null)
 */
class CustomerGroup extends JsonObject
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [static::TYPE => '\DateTime'],
            'lastModifiedAt' => [static::TYPE => '\DateTime'],
            'name' => [static::TYPE => 'string']
        ];
    }
}
