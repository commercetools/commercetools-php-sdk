<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractUpdateRequest;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Orders
 * @apidoc http://dev.sphere.io/http-api-projects-orders.html#update-order
 * @method Order mapResponse(ApiResponseInterface $response)
 */
class OrderUpdateRequest extends AbstractUpdateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Order\Order';

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
