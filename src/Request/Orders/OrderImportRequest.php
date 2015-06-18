<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Order\ImportOrder;
use Sphere\Core\Request\AbstractCreateRequest;

/**
 * Class OrderImportRequest
 * @package Sphere\Core\Request\Orders
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
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/import';
    }
}
