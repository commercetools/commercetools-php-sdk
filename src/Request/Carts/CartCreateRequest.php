<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts;


use Sphere\Core\Model\Cart\Cart;
use Sphere\Core\Model\Cart\CartDraft;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractCreateRequest;

/**
 * Class CategoryCreateRequest
 * @package Sphere\Core\Request\Carts
 * @method static CartCreateRequest of(CartDraft $cartDraft)
 */
class CartCreateRequest extends AbstractCreateRequest
{
    /**
     * @param CartDraft $cartDraft
     * @param Context $context
     */
    public function __construct(CartDraft $cartDraft, Context $context = null)
    {
        parent::__construct(CartsEndpoint::endpoint(), $cartDraft, $context);
    }

    /**
     * @param array $result
     * @param Context $context
     * @return Cart|null
     */
    public function mapResult(array $result, Context $context = null)
    {
        if (!empty($result)) {
            return Cart::fromArray($result, $context);
        }
        return null;
    }
}
