<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Subscription;

use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\Review\ReviewRatingStatistics;
use Commercetools\Core\Model\Common\Address;

/**
 * @package Commercetools\Core\Model\Subscription
 * @link https://dev.commercetools.com/http-api-projects-subscriptions.html#subscription
 * @method string getId()
 * @method Subscription setId(string $id = null)
 * @method int getVersion()
 * @method Subscription setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Subscription setCreatedAt(\DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method Subscription setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method string getKey()
 * @method Subscription setKey(string $key = null)
 * @method Destination getDestination()
 * @method Subscription setDestination(Destination $destination = null)
 * @method MessageSubscriptionCollection getMessages()
 * @method Subscription setMessages(MessageSubscriptionCollection $messages = null)
 * @method ChangeSubscriptionCollection getChanges()
 * @method Subscription setChanges(ChangeSubscriptionCollection $changes = null)
 * @method SubscriptionReference getReference()
 */
class Subscription extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'lastModifiedAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'key' => [static::TYPE => 'string'],
            'destination' => [static::TYPE => '\Commercetools\Core\Model\Subscription\Destination'],
            'messages' => [static::TYPE => '\Commercetools\Core\Model\Subscription\MessageSubscriptionCollection'],
            'changes' => [static::TYPE => '\Commercetools\Core\Model\Subscription\ChangeSubscriptionCollection'],
        ];
    }
}
