<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders;

use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\HttpRequestInterface;
use Commercetools\Core\Client\JsonRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Response\AbstractApiResponse;
use Commercetools\Core\Response\ResourceResponse;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Orders
 * @link https://dev.commercetools.com/http-api-projects-orders.html#create-order-from-cart
 * @method Order mapResponse(ApiResponseInterface $response)
 */
class OrderCreateFromCartRequest extends AbstractApiRequest
{
    const ID = 'id';
    const VERSION = 'version';
    const ORDER_NUMBER = 'orderNumber';
    const PAYMENT_STATE = 'paymentState';

    protected $cartId;
    protected $version;
    protected $orderNumber;
    protected $paymentState;

    protected $resultClass = '\Commercetools\Core\Model\Order\Order';

    /**
     * @return mixed
     */
    public function getCartId()
    {
        return $this->cartId;
    }

    /**
     * @param $cartId
     * @return $this
     */
    public function setCartId($cartId)
    {
        $this->cartId = $cartId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param $version
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * @param $orderNumber
     * @return $this
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentState()
    {
        return $this->paymentState;
    }

    /**
     * @param $paymentState
     * @return $this
     */
    public function setPaymentState($paymentState)
    {
        $this->paymentState = $paymentState;

        return $this;
    }

    /**
     * @param string $cartId
     * @param int $version
     * @param Context $context
     */
    public function __construct($cartId, $version, Context $context = null)
    {
        parent::__construct(OrdersEndpoint::endpoint(), $context);
        $this->setCartId($cartId)->setVersion($version);
    }

    /**
     * @param string $cartId
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofCartIdAndVersion($cartId, $version, Context $context = null)
    {
        return new static($cartId, $version, $context);
    }

    /**
     * @param ResponseInterface $response
     * @return AbstractApiResponse
     * @internal
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new ResourceResponse($response, $this, $this->getContext());
    }

    /**
     * @return HttpRequestInterface
     * @internal
     */
    public function httpRequest()
    {
        $payload = [
            static::ID => $this->getCartId(),
            static::VERSION => $this->getVersion(),
        ];
        if (!is_null($this->paymentState)) {
            $payload[static::PAYMENT_STATE] = $this->getPaymentState();
        }
        if (!is_null($this->orderNumber)) {
            $payload[static::ORDER_NUMBER] = $this->getOrderNumber();
        }
        return new JsonRequest(HttpMethod::POST, $this->getPath(), $payload);
    }
}
