<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
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
    const DESTINATION_SNS = 'SNS';
    const DESTINATION_AZURE_SERVICE_BUS = 'AzureServiceBus';
    const DESTINATION_GOOGLE_CLOUD_PUB_SUB = 'GoogleCloudPubSub';

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string']
        ];
    }

    protected static function destinationType($typeId)
    {
        $types = [
            static::DESTINATION_SQS => SQSDestination::class,
            static::DESTINATION_IRON_MQ => IronMQDestination::class,
            static::DESTINATION_SNS => SNSDestination::class,
            static::DESTINATION_AZURE_SERVICE_BUS => AzureServiceBusDestination::class,
            static::DESTINATION_GOOGLE_CLOUD_PUB_SUB => GoogleCloudPubSubDestination::class,
        ];
        return isset($types[$typeId]) ? $types[$typeId] : Destination::class;
    }

    public static function fromArray(array $data, $context = null)
    {
        if (get_called_class() == Destination::class && isset($data[static::TYPE])) {
            $className = static::destinationType($data[static::TYPE]);
            if (class_exists($className)) {
                return new $className($data, $context);
            }
        }
        return new static($data, $context);
    }
}
