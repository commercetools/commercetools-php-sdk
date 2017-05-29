<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Subscriptions;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Model\Subscription\Subscription;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Subscriptions
 * @link https://dev.commercetools.com/http-api-projects-subscriptions.html#get-a-subscription-by-id
 * @method Subscription mapResponse(ApiResponseInterface $response)
 * @method Subscription mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class SubscriptionByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = Subscription::class;

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(SubscriptionsEndpoint::endpoint(), $id, $context);
    }

    /**
     * @param string $id
     * @param Context $context
     * @return static
     */
    public static function ofId($id, Context $context = null)
    {
        return new static($id, $context);
    }
}
