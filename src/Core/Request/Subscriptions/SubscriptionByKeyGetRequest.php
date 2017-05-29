<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Subscriptions;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Subscription\Subscription;
use Commercetools\Core\Request\AbstractByKeyGetRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Subscriptions
 * @method Subscription mapResponse(ApiResponseInterface $response)
 * @method Subscription mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class SubscriptionByKeyGetRequest extends AbstractByKeyGetRequest
{
    protected $resultClass = Subscription::class;

    /**
     * @param string $key
     * @param Context $context
     */
    public function __construct($key, Context $context = null)
    {
        parent::__construct(SubscriptionsEndpoint::endpoint(), $key, $context);
    }

    /**
     * @param string $key
     * @param Context $context
     * @return static
     */
    public static function ofKey($key, Context $context = null)
    {
        return new static($key, $context);
    }
}
