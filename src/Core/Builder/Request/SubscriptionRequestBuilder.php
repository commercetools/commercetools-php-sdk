<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Model\Subscription\Subscription;
use Commercetools\Core\Model\Subscription\SubscriptionDraft;
use Commercetools\Core\Request\Subscriptions\SubscriptionByIdGetRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionByKeyGetRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionCreateRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionDeleteRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionQueryRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionUpdateRequest;

class SubscriptionRequestBuilder
{
    /**
     * @return SubscriptionQueryRequest
     */
    public function query()
    {
        return SubscriptionQueryRequest::of();
    }

    /**
     * @param Subscription $subscription
     * @return SubscriptionUpdateRequest
     */
    public function update(Subscription $subscription)
    {
        return SubscriptionUpdateRequest::ofIdAndVersion($subscription->getId(), $subscription->getVersion());
    }

    /**
     * @param SubscriptionDraft $subscriptionDraft
     * @return SubscriptionCreateRequest
     */
    public function create(SubscriptionDraft $subscriptionDraft)
    {
        return SubscriptionCreateRequest::ofDraft($subscriptionDraft);
    }

    /**
     * @param Subscription $subscription
     * @return SubscriptionDeleteRequest
     */
    public function delete(Subscription $subscription)
    {
        return SubscriptionDeleteRequest::ofIdAndVersion($subscription->getId(), $subscription->getVersion());
    }

    /**
     * @param $id
     * @return SubscriptionByIdGetRequest
     */
    public function getById($id)
    {
        return SubscriptionByIdGetRequest::ofId($id);
    }

    /**
     * @param $key
     * @return SubscriptionByKeyGetRequest
     */
    public function getByKey($key)
    {
        return SubscriptionByKeyGetRequest::ofKey($key);
    }
}
