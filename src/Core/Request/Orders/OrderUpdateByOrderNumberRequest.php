<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractUpdateRequest;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Request\InStores\InStoreRequestDecorator;
use Commercetools\Core\Request\InStores\InStoreTrait;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Orders
 * @link https://docs.commercetools.com/http-api-projects-orders.html#update-order-by-ordernumber
 * @method Order mapResponse(ApiResponseInterface $response)
 * @method Order mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 * @method OrderUpdateByOrderNumberRequest|InStoreRequestDecorator inStore($storeKey)
 */
class OrderUpdateByOrderNumberRequest extends AbstractUpdateRequest
{
    use InStoreTrait;

    protected $resultClass = Order::class;

    /**
     * @param string $orderNumber
     * @param int $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($orderNumber, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(OrdersEndpoint::endpoint(), $orderNumber, $version, $actions, $context);
    }

    /**
     * @param string $orderNumber
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofOrderNumberAndVersion($orderNumber, $version, Context $context = null)
    {
        return new static($orderNumber, $version, [], $context);
    }

    /**
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->getId();
    }

    /**
     * @param string $orderNumber
     * @return $this
     */
    public function setOrderNumber($orderNumber)
    {
        return $this->setId($orderNumber);
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/order-number=' . urlencode($this->getId()) . $this->getParamString();
    }
}
