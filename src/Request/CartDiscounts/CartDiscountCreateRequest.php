<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts;


use Sphere\Core\Model\CartDiscount\CartDiscountDraft;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractCreateRequest;

class CartDiscountCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Sphere\Core\Model\CartDiscount\CartDiscount';

    /**
     * @param CartDiscountDraft $cartDiscountDraft
     * @param Context $context
     */
    public function __construct(CartDiscountDraft $cartDiscountDraft, Context $context = null)
    {
        parent::__construct(CartDiscountsEndpoint::endpoint(), $cartDiscountDraft, $context);
    }
}
