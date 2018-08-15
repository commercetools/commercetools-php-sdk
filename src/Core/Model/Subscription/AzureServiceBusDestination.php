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
 */
class AzureServiceBusDestination extends Destination
{
    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'connectionString' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @deprecated use ofConnectionString instead
     * @param string $connectionString
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
     * @param string $connectionString
     * @param Context|null $context
     * @return AzureServiceBusDestination
     */
    public static function ofConnectionString($connectionString, Context $context = null)
    {
        return static::of($context)
            ->setType(static::DESTINATION_AZURE_SERVICE_BUS)
            ->setConnectionString($connectionString);
    }
}
