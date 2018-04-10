<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts;

use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\CartReference;
use Commercetools\Core\Model\Cart\ReplicaCartDraft;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Order\OrderReference;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Carts
 * @link https://docs.commercetools.com/http-api-projects-carts.html#replicate-existing-cart-or-order-to-a-new-cart
 * @method Cart mapResponse(ApiResponseInterface $response)
 * @method Cart mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CartReplicateRequest extends AbstractCreateRequest
{
    protected $resultClass = Cart::class;

    /**
     * @param ReplicaCartDraft $replicaCartDraft
     * @param Context $context
     */
    public function __construct(ReplicaCartDraft $replicaCartDraft, Context $context = null)
    {
        parent::__construct(CartsEndpoint::endpoint(), $replicaCartDraft, $context);
    }

    /**
     * @param ReplicaCartDraft $replicaCartDraft
     * @param Context $context
     * @return static
     */
    public static function ofReplicaCartDraft(ReplicaCartDraft $replicaCartDraft, Context $context = null)
    {
        return new static($replicaCartDraft, $context);
    }

    /**
     * @param CartReference $cart
     * @param Context $context
     * @return static
     */
    public static function ofCartReference(CartReference $cart, Context $context = null)
    {
        return static::ofReplicaCartDraft(ReplicaCartDraft::ofCart($cart, $context), $context);
    }

    /**
     * @param $id
     * @param Context $context
     * @return static
     */
    public static function ofCartId($id, Context $context = null)
    {
        return static::ofCartReference(CartReference::ofId($id, $context), $context);
    }

    /**
     * @param OrderReference $order
     * @param Context $context
     * @return static
     */
    public static function ofOrderReference(OrderReference $order, Context $context = null)
    {
        return static::ofReplicaCartDraft(ReplicaCartDraft::ofOrder($order, $context), $context);
    }

    /**
     * @param $id
     * @param Context $context
     * @return static
     */
    public static function ofOrderId($id, Context $context = null)
    {
        return static::ofOrderReference(OrderReference::ofId($id, $context), $context);
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/replicate' . $this->getParamString();
    }
}
