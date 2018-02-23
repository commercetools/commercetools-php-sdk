<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CartDiscounts;

use Commercetools\Core\Model\CartDiscount\CartDiscountDraft;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\CartDiscounts
 * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#create-a-cartdiscount
 * @method CartDiscount mapResponse(ApiResponseInterface $response)
 * @method CartDiscount mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CartDiscountCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = CartDiscount::class;

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
