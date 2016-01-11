<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts;

use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Carts
 * @apidoc http://dev.sphere.io/http-api-projects-carts.html#create-cart
 * @method Cart mapResponse(ApiResponseInterface $response)
 */
class CartCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Cart\Cart';

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
