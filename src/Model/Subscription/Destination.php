<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Subscription;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Subscription
 *
 * @method string getType()
 * @method Destination setType(string $type = null)
 */
class Destination extends JsonObject
{
    const DESTINATION_SQS = 'SQS';
    const DESTINATION_IRON_MQ = 'IronMQ';

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string']
        ];
    }

    protected static function destinationType($typeId)
    {
        $types = [
            static::DESTINATION_SQS => '\Commercetools\Core\Model\Subscription\SQSDestination',
            static::DESTINATION_IRON_MQ => '\Commercetools\Core\Model\Subscription\IronMQDestination',
        ];
        return isset($types[$typeId]) ? $types[$typeId] : '\Commercetools\Core\Model\Subscription\Destination';
    }

    public static function fromArray(array $data, $context = null)
    {
        if (get_called_class() == 'Commercetools\Core\Model\Subscription\Destination' && isset($data[static::TYPE])) {
            $className = static::destinationType($data[static::TYPE]);
            if (class_exists($className)) {
                return new $className($data, $context);
            }
        }
        return new static($data, $context);
    }
}
