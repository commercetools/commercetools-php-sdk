<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Builder;

use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Model\CartDiscount\CartDiscountDraft;
use Commercetools\Core\Request\CartDiscounts\CartDiscountByIdGetRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountCreateRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountDeleteRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountQueryRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountUpdateRequest;

class CartDiscountRequestBuilder
{
    /**
     * @return CartDiscountQueryRequest
     */
    public function query()
    {
        return CartDiscountQueryRequest::of();
    }

    /**
     * @param CartDiscount $cartDiscount
     * @return CartDiscountUpdateRequest
     */
    public function update(CartDiscount $cartDiscount)
    {
        return CartDiscountUpdateRequest::ofIdAndVersion($cartDiscount->getId(), $cartDiscount->getVersion());
    }

    /**
     * @param CartDiscountDraft $cartDiscountDraft
     * @return CartDiscountCreateRequest
     */
    public function create(CartDiscountDraft $cartDiscountDraft)
    {
        return CartDiscountCreateRequest::ofDraft($cartDiscountDraft);
    }

    /**
     * @param CartDiscount $cartDiscount
     * @return CartDiscountDeleteRequest
     */
    public function delete(CartDiscount $cartDiscount)
    {
        return CartDiscountDeleteRequest::ofIdAndVersion($cartDiscount->getId(), $cartDiscount->getVersion());
    }

    /**
     * @param $id
     * @return CartDiscountByIdGetRequest
     */
    public function getById($id)
    {
        return CartDiscountByIdGetRequest::ofId($id);
    }
}
