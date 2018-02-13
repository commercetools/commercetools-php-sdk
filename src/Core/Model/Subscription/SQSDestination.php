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
 * @method SQSDestination setType(string $type = null)
 * @method string getUri()
 * @method IronMQDestination setUri(string $uri = null)
 * @method string getQueueURL()
 * @method SQSDestination setQueueURL(string $queueURL = null)
 * @method string getAccessKey()
 * @method SQSDestination setAccessKey(string $accessKey = null)
 * @method string getAccessSecret()
 * @method SQSDestination setAccessSecret(string $accessSecret = null)
 * @method string getRegion()
 * @method SQSDestination setRegion(string $region = null)
 */
class SQSDestination extends Destination
{
    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'queueURL' => [static::TYPE => 'string'],
            'accessKey' => [static::TYPE => 'string'],
            'accessSecret' => [static::TYPE => 'string'],
            'region' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param $uri
     * @param $accessKey
     * @param $accessSecret
     * @param Context|null $context
     * @return SQSDestination
     */
    public static function ofQueueURLAccessKeyAndSecret($uri, $accessKey, $accessSecret, Context $context = null)
    {
        return static::of($context)
            ->setType('SQS')
            ->setQueueURL($uri)
            ->setAccessKey($accessKey)
            ->setAccessSecret($accessSecret);
    }
}
