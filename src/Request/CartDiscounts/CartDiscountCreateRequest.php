<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CartDiscounts;

use Commercetools\Core\Model\CartDiscount\CartDiscountDraft;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\CartDiscounts
 *
 * @method CartDiscount mapResponse(ApiResponseInterface $response)
 */
class CartDiscountCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\CartDiscount\CartDiscount';

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
