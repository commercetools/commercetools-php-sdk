<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\Order\OrderCollection;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Orders
 * @apidoc http://dev.sphere.io/http-api-projects-orders.html#orders-by-query
 * @method OrderCollection mapResponse(ApiResponseInterface $response)
 */
class OrderQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Order\OrderCollection';

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
