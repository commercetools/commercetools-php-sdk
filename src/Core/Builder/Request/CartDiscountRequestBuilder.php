<?php
// phpcs:ignoreFile
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\CartDiscounts\CartDiscountByIdGetRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountCreateRequest;
use Commercetools\Core\Model\CartDiscount\CartDiscountDraft;
use Commercetools\Core\Request\CartDiscounts\CartDiscountDeleteRequest;
use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Request\CartDiscounts\CartDiscountQueryRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountUpdateRequest;

class CartDiscountRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#get-cartdiscount-by-id
     * @param string $id
     * @return CartDiscountByIdGetRequest
     */
    public function getById($id)
    {
        $request = CartDiscountByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#create-a-cartdiscount
     * @param CartDiscountDraft $cartDiscountDraft
     * @return CartDiscountCreateRequest
     */
    public function create(CartDiscountDraft $cartDiscountDraft)
    {
        $request = CartDiscountCreateRequest::ofDraft($cartDiscountDraft);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#delete-cartdiscount
     * @param CartDiscount $cartDiscount
     * @return CartDiscountDeleteRequest
     */
    public function delete(CartDiscount $cartDiscount)
    {
        $request = CartDiscountDeleteRequest::ofIdAndVersion($cartDiscount->getId(), $cartDiscount->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#query-cartdiscounts
     * @param 
     * @return CartDiscountQueryRequest
     */
    public function query()
    {
        $request = CartDiscountQueryRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#update-cartdiscount
     * @param CartDiscount $cartDiscount
     * @return CartDiscountUpdateRequest
     */
    public function update(CartDiscount $cartDiscount)
    {
        $request = CartDiscountUpdateRequest::ofIdAndVersion($cartDiscount->getId(), $cartDiscount->getVersion());
        return $request;
    }

    /**
     * @return CartDiscountRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
