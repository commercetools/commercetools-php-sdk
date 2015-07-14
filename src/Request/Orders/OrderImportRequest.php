<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Order\ImportOrder;
use Sphere\Core\Request\AbstractCreateRequest;
use Sphere\Core\Model\Order\Order;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * Class OrderImportRequest
 * @package Sphere\Core\Request\Orders
 * @method Order mapResponse(ApiResponseInterface $response)
 */
class OrderImportRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Sphere\Core\Model\Order\Order';

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
        return (string)$this->getEndpoint() . '/import';
    }
}
