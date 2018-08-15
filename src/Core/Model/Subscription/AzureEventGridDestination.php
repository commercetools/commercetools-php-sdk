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
 * @method AzureEventGridDestination setType(string $type = null)
 * @method string getUri()
 * @method AzureEventGridDestination setUri(string $uri = null)
 * @method string getAccessKey()
 * @method AzureEventGridDestination setAccessKey(string $accessKey = null)
 */
class AzureEventGridDestination extends Destination
{
    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'uri' => [static::TYPE => 'string'],
            'accessKey' => [static::TYPE => 'string'],
        ];
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
            ->setType(static::DESTINATION_AZURE_EVENT_GRID)
            ->setUri($uri)
            ->setAccessKey($accessKey);
    }
}
