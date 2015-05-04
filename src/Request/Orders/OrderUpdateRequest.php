<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractUpdateRequest;

/**
 * Class OrderUpdateRequest
 * @package Sphere\Core\Request\Orders
 * @link http://dev.sphere.io/http-api-projects-orders.html#update-order
 */
class OrderUpdateRequest extends AbstractUpdateRequest
{
    protected $resultClass = '\Sphere\Core\Model\Order\Order';

    /**
     * @param string $id
     * @param int $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($id, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(OrdersEndpoint::endpoint(), $id, $version, $actions, $context);
    }
}
