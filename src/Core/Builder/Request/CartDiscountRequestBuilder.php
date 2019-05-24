<?php
// phpcs:disable Generic.Files.LineLength
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\CartDiscounts\CartDiscountByIdGetRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountByKeyGetRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountCreateRequest;
use Commercetools\Core\Model\CartDiscount\CartDiscountDraft;
use Commercetools\Core\Request\CartDiscounts\CartDiscountDeleteByKeyRequest;
use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Request\CartDiscounts\CartDiscountDeleteRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountQueryRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountUpdateByKeyRequest;
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
     *
     * @param string $key
     * @return CartDiscountByKeyGetRequest
     */
    public function getByKey($key)
    {
        $request = CartDiscountByKeyGetRequest::ofKey($key);
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
     *
     * @param CartDiscount $cartDiscount
     * @return CartDiscountDeleteByKeyRequest
     */
    public function deleteByKey(CartDiscount $cartDiscount)
    {
        $request = CartDiscountDeleteByKeyRequest::ofKeyAndVersion($cartDiscount->getKey(), $cartDiscount->getVersion());
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
     *
     * @return CartDiscountQueryRequest
     */
    public function query()
    {
        $request = CartDiscountQueryRequest::of();
        return $request;
    }

    /**
     *
     * @param CartDiscount $cartDiscount
     * @return CartDiscountUpdateByKeyRequest
     */
    public function updateByKey(CartDiscount $cartDiscount)
    {
        $request = CartDiscountUpdateByKeyRequest::ofKeyAndVersion($cartDiscount->getKey(), $cartDiscount->getVersion());
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
