<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractUpdateRequest;
use Sphere\Core\Model\Order\Order;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\Orders
 * @apidoc http://dev.sphere.io/http-api-projects-orders.html#update-order
 * @method Order mapResponse(ApiResponseInterface $response)
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

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofIdAndVersion($id, $version, Context $context = null)
    {
        return new static($id, $version, [], $context);
    }
}
