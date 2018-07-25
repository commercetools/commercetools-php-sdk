<?php
/**
 */

namespace Commercetools\Core\Model\Subscription;

use Commercetools\Core\Model\Common\Context;

/**
 * @package Commercetools\Core\Model\Subscription
 *
 * @method string getType()
 * @method GoogleCloudPubSubDestination setType(string $type = null)
 * @method string getProjectId()
 * @method GoogleCloudPubSubDestination setProjectId(string $projectId = null)
 * @method string getTopic()
 * @method GoogleCloudPubSubDestination setTopic(string $topic = null)
 */
class GoogleCloudPubSubDestination extends Destination
{
    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'projectId' => [static::TYPE => 'string'],
            'topic' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param string $projectId
     * @param string $topic
     * @param Context $context
     * @return GoogleCloudPubSubDestination
     */
    public static function ofProjectIdAndTopic($projectId, $topic, Context $context = null)
    {
        return static::of($context)->setType('GoogleCloudPubSub')->setProjectId($projectId)->setTopic($topic);
    }
}
