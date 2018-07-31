<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Subscription;

use Commercetools\Core\Model\Common\Context;

/**
 * @package Commercetools\Core\Model\Subscription
 *
 * @method string getType()
 * @method AzureServiceBusDestination setType(string $type = null)
 * @method string getConnectionString()
 * @method AzureServiceBusDestination setConnectionString(string $connectionString = null)
 * @method string getUri()
 * @method AzureServiceBusDestination setUri(string $uri = null)
 * @method string getAccessKey()
 * @method AzureServiceBusDestination setAccessKey(string $accessKey = null)
 */
class AzureServiceBusDestination extends Destination
{
    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'connectionString' => [static::TYPE => 'string'],
            'uri' => [static::TYPE => 'string'],
            'accessKey' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param $connectionString
     * @param Context|null $context
     * @return AzureServiceBusDestination
     */
    public static function ofQueueURLAccessKeyAndSecret($connectionString, Context $context = null)
    {
        return static::of($context)
            ->setType(static::DESTINATION_AZURE_SERVICE_BUS)
            ->setConnectionString($connectionString);
    }

    /**
     * @param $uri
     * @param $accessKey
     * @param Context|null $context
     * @return AzureServiceBusDestination
     */
    public static function ofUriAndAccessKey($uri, $accessKey, Context $context = null)
    {
        return static::of($context)
            ->setType(static::DESTINATION_AZURE_SERVICE_BUS)
            ->setUri($uri)
            ->setAccessKey($accessKey);
    }
}
