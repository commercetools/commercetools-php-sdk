<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\CustomObject;

use Sphere\Core\Model\Common\JsonObject;

/**
 * Class CustomObject
 * @package Sphere\Core\Model\CustomObject
 * @method string getId()
 * @method CustomObject setId(string $id = null)
 * @method int getVersion()
 * @method CustomObject setVersion(int $version = null)
 * @method \DateTime getCreatedAt()
 * @method CustomObject setCreatedAt(\DateTime $createdAt = null)
 * @method \DateTime getLastModifiedAt()
 * @method CustomObject setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method string getContainer()
 * @method CustomObject setContainer(string $container = null)
 * @method string getKey()
 * @method CustomObject setKey(string $key = null)
 * @method string getValue()
 * @method CustomObject setValue(string $value = null)
 */
class CustomObject extends JsonObject
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [static::TYPE => '\DateTime'],
            'lastModifiedAt' => [static::TYPE => '\DateTime'],
            'container' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string'],
            'value' => [static::TYPE => 'string'],
        ];
    }
}
