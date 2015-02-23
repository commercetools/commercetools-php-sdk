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
 * @package Sphere\Core\Request\Categories
 * @method static CartCreateRequest of(CartDraft $category)
 */
class CartCreateRequest extends AbstractCreateRequest
{
    /**
     * @param CartDraft $category
     * @param Context $context
     */
    public function __construct(CartDraft $category, Context $context = null)
    {
        parent::__construct(CartsEndpoint::endpoint(), $category, $context);
    }
}
