<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractDeleteRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Orders
 * @link https://dev.commercetools.com/http-api-projects-orders.html#delete-order-by-ordernumber
 * @method Order mapResponse(ApiResponseInterface $response)
 * @method Order mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class OrderDeleteByOrderNumberRequest extends AbstractDeleteRequest
{
    protected $resultClass = Order::class;

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(OrdersEndpoint::endpoint(), $id, $version, $context);
    }

    /**
     * @param string $orderNumber
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofOrderNumberAndVersion($orderNumber, $version, Context $context = null)
    {
        return new static($orderNumber, $version, $context);
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
