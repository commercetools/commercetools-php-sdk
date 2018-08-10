<?php

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\Subscriptions\SubscriptionByIdGetRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionByKeyGetRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionCreateRequest;
use Commercetools\Core\Model\Subscription\SubscriptionDraft;
use Commercetools\Core\Request\Subscriptions\SubscriptionDeleteByKeyRequest;
use Commercetools\Core\Model\Subscription\Subscription;
use Commercetools\Core\Request\Subscriptions\SubscriptionDeleteRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionQueryRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionUpdateByKeyRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionUpdateRequest;

class SubscriptionRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-subscriptions.html#get-a-subscription-by-id
     * @param string $id
     * @return SubscriptionByIdGetRequest
     */
    public function getById($id)
    {
        $request = SubscriptionByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     *
     * @param string $key
     * @return SubscriptionByKeyGetRequest
     */
    public function getByKey($key)
    {
        $request = SubscriptionByKeyGetRequest::ofKey($key);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-subscriptions.html#create-a-subscription
     * @param SubscriptionDraft $subscription
     * @return SubscriptionCreateRequest
     */
    public function create(SubscriptionDraft $subscription)
    {
        $request = SubscriptionCreateRequest::ofDraft($subscription);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-subscriptions.html#delete-subscription-by-key
     * @param Subscription $subscription
     * @return SubscriptionDeleteByKeyRequest
     */
    public function deleteByKey(Subscription $subscription)
    {
        $request = SubscriptionDeleteByKeyRequest::ofKeyAndVersion($subscription->getKey(), $subscription->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-subscriptions.html#delete-subscription
     * @param Subscription $subscription
     * @return SubscriptionDeleteRequest
     */
    public function delete(Subscription $subscription)
    {
        $request = SubscriptionDeleteRequest::ofIdAndVersion($subscription->getId(), $subscription->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-subscriptions.html#query-subscriptions
     * @param 
     * @return SubscriptionQueryRequest
     */
    public function query()
    {
        $request = SubscriptionQueryRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-subscriptions.html#update-subscription-by-key
     * @param Subscription $subscription
     * @return SubscriptionUpdateByKeyRequest
     */
    public function updateByKey(Subscription $subscription)
    {
        $request = SubscriptionUpdateByKeyRequest::ofKeyAndVersion($subscription->getKey(), $subscription->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-subscriptions.html#update-subscription
     * @param Subscription $subscription
     * @return SubscriptionUpdateRequest
     */
    public function update(Subscription $subscription)
    {
        $request = SubscriptionUpdateRequest::ofIdAndVersion($subscription->getId(), $subscription->getVersion());
        return $request;
    }

    /**
     * @return SubscriptionRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
