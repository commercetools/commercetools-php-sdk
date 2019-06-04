<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\Order\OrderCollection;
use Commercetools\Core\Request\InStores\InStoreRequestDecorator;
use Commercetools\Core\Request\InStores\InStoreTrait;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Orders
 * @link https://docs.commercetools.com/http-api-projects-orders.html#query-orders
 * @method OrderCollection mapResponse(ApiResponseInterface $response)
 * @method OrderCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 * @method OrderQueryRequest|InStoreRequestDecorator inStore($storeKey)
 */
class OrderQueryRequest extends AbstractQueryRequest
{
    use InStoreTrait;

    protected $resultClass = OrderCollection::class;

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(OrdersEndpoint::endpoint(), $context);
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
