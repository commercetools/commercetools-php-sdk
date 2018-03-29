<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\Subscriptions\Command\SubscriptionSetChangesAction;
use Commercetools\Core\Request\Subscriptions\Command\SubscriptionSetMessagesAction;
use Commercetools\Core\Request\Subscriptions\Command\SubscriptionSetKeyAction;

class SubscriptionsActionBuilder
{
    /**
     * @link https://docs.commercetools.com/http-api-projects-subscriptions.html#set-changes
     * @param array $data
     * @return SubscriptionSetChangesAction
     */
    public function setChanges(array $data = [])
    {
        return new SubscriptionSetChangesAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-subscriptions.html#set-messages
     * @param array $data
     * @return SubscriptionSetMessagesAction
     */
    public function setMessages(array $data = [])
    {
        return new SubscriptionSetMessagesAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-subscriptions.html#set-key
     * @param array $data
     * @return SubscriptionSetKeyAction
     */
    public function setKey(array $data = [])
    {
        return new SubscriptionSetKeyAction($data);
    }

    /**
     * @return SubscriptionsActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
