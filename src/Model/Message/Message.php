<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Message;


use Sphere\Core\Model\Common\JsonObject;

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
