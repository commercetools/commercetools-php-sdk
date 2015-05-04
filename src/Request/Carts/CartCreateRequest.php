<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts;

use Sphere\Core\Model\Cart\CartDraft;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractCreateRequest;

/**
 * Class CategoryCreateRequest
 * @package Sphere\Core\Request\Carts
 * @link http://dev.sphere.io/http-api-projects-carts.html#create-cart
 * @method static CartCreateRequest of(CartDraft $cartDraft)
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
}
