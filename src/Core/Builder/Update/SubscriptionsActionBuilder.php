<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\Subscriptions\Command\SubscriptionSetChangesAction;
use Commercetools\Core\Request\Subscriptions\Command\SubscriptionSetMessagesAction;
use Commercetools\Core\Request\Subscriptions\Command\SubscriptionSetKeyAction;

class SubscriptionsActionBuilder
{
    /**
     * @return SubscriptionSetChangesAction
     */
    public function setChanges()
    {
        return SubscriptionSetChangesAction::of();
    }

    /**
     * @return SubscriptionSetMessagesAction
     */
    public function setMessages()
    {
        return SubscriptionSetMessagesAction::of();
    }

    /**
     * @return SubscriptionSetKeyAction
     */
    public function setKey()
    {
        return SubscriptionSetKeyAction::of();
    }
}
