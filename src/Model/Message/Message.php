<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Message;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\Reference;

/**
 * Class Message
 * @package Sphere\Core\Model\Message
 * @method string getId()
 * @method Message setId(string $id = null)
 * @method \DateTime getCreatedAt()
 * @method Message setCreatedAt(\DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method Message setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method Message setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method Message setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method Message setType(string $type = null)
 */
class Message extends JsonObject
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'createdAt' => [static::TYPE => '\DateTime'],
            'sequenceNumber' => [static::TYPE => 'int'],
            'resource' => [static::TYPE => '\Sphere\Core\Model\Common\Reference'],
            'resourceVersion' => [static::TYPE => 'int'],
            'type' => [static::TYPE => 'string'],
        ];
    }
}
