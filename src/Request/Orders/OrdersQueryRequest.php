<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractQueryRequest;
use Sphere\Core\Model\Order\OrderCollection;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * Class OrdersQueryRequest
 * @package Sphere\Core\Request\Orders
 * @link http://dev.sphere.io/http-api-projects-orders.html#orders-by-query
 * @method OrderCollection mapResponse(ApiResponseInterface $response)
 */
class OrdersQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Sphere\Core\Model\Order\OrderCollection';

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
