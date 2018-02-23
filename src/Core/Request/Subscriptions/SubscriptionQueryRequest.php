<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Subscriptions;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Subscription\SubscriptionCollection;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Subscriptions
 * @link https://docs.commercetools.com/http-api-projects-subscriptions.html#query-subscriptions
 * @method SubscriptionCollection mapResponse(ApiResponseInterface $response)
 * @method SubscriptionCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class SubscriptionQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = SubscriptionCollection::class;

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(SubscriptionsEndpoint::endpoint(), $context);
    }

    /**
     * @param Context $context
     * @return static
     */
    public static function of(Context $context = null)
    {
        return new static($context);
    }
}
