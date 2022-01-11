<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders;

use Commercetools\Core\Model\Cart\CartReference;
use Commercetools\Core\Model\State\StateReference;
use Commercetools\Core\Request\InStores\InStoreRequestDecorator;
use Commercetools\Core\Request\InStores\InStoreTrait;
use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\JsonRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Response\AbstractApiResponse;
use Commercetools\Core\Response\ResourceResponse;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Orders
 * @link https://docs.commercetools.com/http-api-projects-orders.html#create-order-from-cart
 * @method Order mapResponse(ApiResponseInterface $response)
 * @method Order mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 * @method OrderCreateFromCartRequest|InStoreRequestDecorator inStore($storeKey)
 */
class OrderCreateFromCartRequest extends AbstractApiRequest
{
    use InStoreTrait;

    const ID = 'id';
    const CART = 'cart';
    const VERSION = 'version';
    const ORDER_NUMBER = 'orderNumber';
    const PAYMENT_STATE = 'paymentState';
    const ORDER_STATE = 'orderState';
    const STATE = 'state';
    const SHIPMENT_STATE = 'shipmentState';

    /**
     * @deprecated use $cart instead
     */
    protected $cartId;
    /**
     * @var CartReference
     */
    protected $cart;
    protected $version;
    protected $orderNumber;
    protected $paymentState;
    protected $orderState;
    protected $state;
    protected $shipmentState;

    protected $resultClass = Order::class;

    /**
     * @param CartReference|string $cart
     * @param int $version
     * @param Context $context
     */
    public function __construct($cart, $version = null, Context $context = null)
    {
        parent::__construct(OrdersEndpoint::endpoint(), $context);

        if ($cart instanceof CartReference) {
            $this->setCart($cart)->setVersion($version);
        } else {
            $this->setCart(CartReference::ofId($cart))->setVersion($version);
        }
    }

    /**
     * @return string
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * @param CartReference $cart
     * @return $this
     */
    public function setCart($cart)
    {
        $this->cart = $cart;

        return $this;
    }

    /**
     * @deprecated use getCart instead
     * @return string
     */
    public function getCartId()
    {
        if ($this->cart == null) {
            return null;
        }
        return $this->cart->getId();
    }

    /**
     * @deprecated use setCart instead
     * @param string $cartId
     * @return $this
     */
    public function setCartId($cartId)
    {
        $this->cart = CartReference::ofId($cartId);

        return $this;
    }

    /**
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param int $version
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * @param string $orderNumber
     * @return $this
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentState()
    {
        return $this->paymentState;
    }

    /**
     * @param string $paymentState
     * @return $this
     */
    public function setPaymentState($paymentState)
    {
        $this->paymentState = $paymentState;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrderState()
    {
        return $this->orderState;
    }

    /**
     * @param string $orderState
     * @return $this
     */
    public function setOrderState($orderState)
    {
        $this->orderState = $orderState;

        return $this;
    }

    /**
     * @return StateReference
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param StateReference $state
     * @return $this
     */
    public function setState(StateReference $state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return string
     */
    public function getShipmentState()
    {
        return $this->shipmentState;
    }

    /**
     * @param string $shipmentState
     * @return $this
     */
    public function setShipmentState($shipmentState)
    {
        $this->shipmentState = $shipmentState;

        return $this;
    }

    /**
     * @deprecated use ofCartAndVersion instead
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
     * @param CartReference|string $cart
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofCartAndVersion($cart, $version, Context $context = null)
    {
        return new static($cart, $version, $context);
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
     * @return JsonRequest
     * @internal
     */
    public function httpRequest()
    {
        $payload = [
            static::CART => $this->getCart(),
            static::VERSION => $this->getVersion(),
        ];
        if (!is_null($this->paymentState)) {
            $payload[static::PAYMENT_STATE] = $this->getPaymentState();
        }
        if (!is_null($this->orderNumber)) {
            $payload[static::ORDER_NUMBER] = $this->getOrderNumber();
        }
        if (!is_null($this->orderState)) {
            $payload[static::ORDER_STATE] = $this->getOrderState();
        }
        if (!is_null($this->state)) {
            $payload[static::STATE] = $this->getState();
        }
        if (!is_null($this->shipmentState)) {
            $payload[static::SHIPMENT_STATE] = $this->getShipmentState();
        }
        return new JsonRequest(HttpMethod::POST, $this->getPath(), $payload);
    }
}
