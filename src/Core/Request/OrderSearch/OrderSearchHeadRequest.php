<?php

namespace Commercetools\Core\Request\OrderSearch;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Request\AbstractHeadRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Orders
 *
 * @method Order mapResponse(ApiResponseInterface $response)
 * @method Order mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class OrderSearchHeadRequest extends AbstractHeadRequest
{
    protected $resultClass = Order::class;

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(OrdersEndpoint::endpoint(), $context);
    }

    /**
     * @param Context $context
     * @return static
     */
    public static function of(Context $context = null)
    {
        return new static($context);
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/search' . $this->getParamString();
    }
}
