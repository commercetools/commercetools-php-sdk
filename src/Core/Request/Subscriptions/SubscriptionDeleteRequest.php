<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Subscriptions;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Subscription\Subscription;
use Commercetools\Core\Request\AbstractDeleteRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Subscriptions
 * @link https://docs.commercetools.com/http-api-projects-subscriptions.html#delete-subscription
 * @method Subscription mapResponse(ApiResponseInterface $response)
 * @method Subscription mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class SubscriptionDeleteRequest extends AbstractDeleteRequest
{
    protected $resultClass = Subscription::class;

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(SubscriptionsEndpoint::endpoint(), $id, $version, $context);
    }

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofIdAndVersion($id, $version, Context $context = null)
    {
        return new static($id, $version, $context);
    }
}
