<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Subscriptions;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Subscription\Subscription;
use Commercetools\Core\Model\Subscription\SubscriptionDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Subscriptions
 * @link https://dev.commercetools.com/http-api-projects-subscriptions.html#create-a-subscription
 * @method Subscription mapResponse(ApiResponseInterface $response)
 * @method Subscription mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class SubscriptionCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Subscription\Subscription';

    /**
     * @param SubscriptionDraft $subscription
     * @param Context $context
     */
    public function __construct(SubscriptionDraft $subscription, Context $context = null)
    {
        parent::__construct(SubscriptionsEndpoint::endpoint(), $subscription, $context);
    }

    /**
     * @param SubscriptionDraft $subscription
     * @param Context $context
     * @return static
     */
    public static function ofDraft(SubscriptionDraft $subscription, Context $context = null)
    {
        return new static($subscription, $context);
    }
}
