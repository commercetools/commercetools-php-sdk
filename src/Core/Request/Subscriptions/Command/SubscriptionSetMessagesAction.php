<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Subscriptions\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Subscription\MessageSubscriptionCollection;

/**
 * @package Commercetools\Core\Request\Subscriptions\Command
 *
 * @method string getAction()
 * @method SubscriptionSetMessagesAction setAction(string $action = null)
 * @method MessageSubscriptionCollection getMessages()
 * @method SubscriptionSetMessagesAction setMessages(MessageSubscriptionCollection $messages = null)
 */
class SubscriptionSetMessagesAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'messages' => [static::TYPE => MessageSubscriptionCollection::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setMessages');
    }
}
