<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts;

use Sphere\Core\Model\Cart\CartDraft;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractCreateRequest;
use Sphere\Core\Model\Cart\Cart;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\Carts
 * @link http://dev.sphere.io/http-api-projects-carts.html#create-cart
 * @method Cart mapResponse(ApiResponseInterface $response)
 */
class CartCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Sphere\Core\Model\Cart\Cart';

    /**
     * @param CartDraft $cartDraft
     * @param Context $context
     */
    public function __construct(CartDraft $cartDraft, Context $context = null)
    {
        parent::__construct(CartsEndpoint::endpoint(), $cartDraft, $context);
    }

    /**
     * @param CartDraft $cartDraft
     * @param Context $context
     * @return static
     */
    public static function ofDraft(CartDraft $cartDraft, Context $context = null)
    {
        return new static($cartDraft, $context);
    }
}
