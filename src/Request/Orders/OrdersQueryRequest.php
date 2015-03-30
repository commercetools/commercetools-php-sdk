<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractQueryRequest;

/**
 * Class OrdersQueryRequest
 * @package Sphere\Core\Request\Orders
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
}
