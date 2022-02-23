<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Subscription;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\Common\Address;

/**
 * @package Commercetools\Core\Model\Subscription
 * @link https://docs.commercetools.com/http-api-projects-subscriptions.html#subscriptiondraft
 * @method string getKey()
 * @method SubscriptionDraft setKey(string $key = null)
 * @method Destination getDestination()
 * @method SubscriptionDraft setDestination(Destination $destination = null)
 * @method MessageSubscriptionCollection getMessages()
 * @method SubscriptionDraft setMessages(MessageSubscriptionCollection $messages = null)
 * @method ChangeSubscriptionCollection getChanges()
 * @method SubscriptionDraft setChanges(ChangeSubscriptionCollection $changes = null)
 */
class SubscriptionDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'key' => [static::TYPE => 'string', static::OPTIONAL => true],
            'destination' => [static::TYPE => Destination::class],
            'messages' => [static::TYPE => MessageSubscriptionCollection::class, static::OPTIONAL => true],
            'changes' => [static::TYPE => ChangeSubscriptionCollection::class, static::OPTIONAL => true],
        ];
    }

    /**
     * @param Destination $destination
     * @param MessageSubscriptionCollection $messages
     * @param Context|callable $context
     * @return SubscriptionDraft
     */
    public static function ofDestinationAndMessages(
        Destination $destination,
        MessageSubscriptionCollection $messages,
        $context = null
    ) {
        return static::of($context)->setDestination($destination)->setMessages($messages);
    }

    /**
     * @param Destination $destination
     * @param ChangeSubscriptionCollection $changes
     * @param Context|callable $context
     * @return SubscriptionDraft
     */
    public static function ofDestinationAndChanges(
        Destination $destination,
        ChangeSubscriptionCollection $changes,
        $context = null
    ) {
        return static::of($context)->setDestination($destination)->setChanges($changes);
    }

    /**
     * @param string $key
     * @param Destination $destination
     * @param MessageSubscriptionCollection $messages
     * @param Context|callable $context
     * @return SubscriptionDraft
     */
    public static function ofKeyDestinationAndMessages(
        $key,
        Destination $destination,
        MessageSubscriptionCollection $messages,
        $context = null
    ) {
        return static::of($context)->setKey($key)->setDestination($destination)->setMessages($messages);
    }
}
