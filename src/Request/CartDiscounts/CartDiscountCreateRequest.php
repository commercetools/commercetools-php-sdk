<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts;

use Sphere\Core\Model\CartDiscount\CartDiscountDraft;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractCreateRequest;
use Sphere\Core\Model\CartDiscount\CartDiscount;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * Class CartDiscountCreateRequest
 * @package Sphere\Core\Request\CartDiscounts
 * 
 * @method CartDiscount mapResponse(ApiResponseInterface $response)
 */
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

    /**
     * @param CartDiscountDraft $cartDiscountDraft
     * @param Context $context
     * @return static
     */
    public static function ofDraft(CartDiscountDraft $cartDiscountDraft, Context $context = null)
    {
        return new static($cartDiscountDraft, $context);
    }
}
