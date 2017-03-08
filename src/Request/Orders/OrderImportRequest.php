<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Order\ImportOrder;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Orders
 * @link https://dev.commercetools.com/http-api-projects-orders-import.html#create-an-order-by-import
 * @method Order mapResponse(ApiResponseInterface $response)
 * @method Order mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class OrderImportRequest extends AbstractCreateRequest
{
    protected $resultClass = Order::class;

    /**
     * @param ImportOrder $importOrder
     * @param Context $context
     */
    public function __construct(ImportOrder $importOrder, Context $context = null)
    {
        parent::__construct(OrdersEndpoint::endpoint(), $importOrder, $context);
    }

    /**
     * @param ImportOrder $importOrder
     * @param Context $context
     * @return static
     */
    public static function ofImportOrder(ImportOrder $importOrder, Context $context = null)
    {
        return new static($importOrder, $context);
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/import' . $this->getParamString();
    }
}
