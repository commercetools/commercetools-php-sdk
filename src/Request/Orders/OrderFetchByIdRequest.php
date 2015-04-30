<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractFetchByIdRequest;

/**
 * Class OrderFetchByIdRequest
 * @package Sphere\Core\Request\Orders
 * @link http://dev.sphere.io/http-api-projects-orders.html#order-by-id
 */
class OrderFetchByIdRequest extends AbstractFetchByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\Order\Order';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(OrdersEndpoint::endpoint(), $id, $context);
    }
}
