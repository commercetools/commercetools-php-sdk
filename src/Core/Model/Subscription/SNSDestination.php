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
 * @method SNSDestination setType(string $type = null)
 * @method string getTopicArn()
 * @method SNSDestination setTopicArn(string $topicArn = null)
 * @method string getAccessKey()
 * @method SNSDestination setAccessKey(string $accessKey = null)
 * @method string getAccessSecret()
 * @method SNSDestination setAccessSecret(string $accessSecret = null)
 */
class SNSDestination extends Destination
{
    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'topicArn' => [static::TYPE => 'string'],
            'accessKey' => [static::TYPE => 'string'],
            'accessSecret' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param string $topicArn
     * @param string $accessKey
     * @param string $accessSecret
     * @param Context|null $context
     * @return SNSDestination
     */
    public static function ofTopicArnAccessKeyAndSecret($topicArn, $accessKey, $accessSecret, Context $context = null)
    {
        return static::of($context)->setType(static::DESTINATION_SNS)
            ->setTopicArn($topicArn)->setAccessKey($accessKey)->setAccessSecret($accessSecret);
    }
}
