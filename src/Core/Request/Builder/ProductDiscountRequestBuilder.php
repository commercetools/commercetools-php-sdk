<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Builder;

use Commercetools\Core\Model\ProductDiscount\ProductDiscount;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountDraft;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountByIdGetRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountCreateRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountDeleteRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountQueryRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountUpdateRequest;

class ProductDiscountRequestBuilder
{
    /**
     * @return ProductDiscountQueryRequest
     */
    public function query()
    {
        return ProductDiscountQueryRequest::of();
    }

    /**
     * @param ProductDiscount $productDiscount
     * @return ProductDiscountUpdateRequest
     */
    public function update(ProductDiscount $productDiscount)
    {
        return ProductDiscountUpdateRequest::ofIdAndVersion($productDiscount->getId(), $productDiscount->getVersion());
    }

    /**
     * @param ProductDiscountDraft $productDiscountDraft
     * @return ProductDiscountCreateRequest
     */
    public function create(ProductDiscountDraft $productDiscountDraft)
    {
        return ProductDiscountCreateRequest::ofDraft($productDiscountDraft);
    }

    /**
     * @param ProductDiscount $productDiscount
     * @return ProductDiscountDeleteRequest
     */
    public function delete(ProductDiscount $productDiscount)
    {
        return ProductDiscountDeleteRequest::ofIdAndVersion($productDiscount->getId(), $productDiscount->getVersion());
    }

    /**
     * @param $id
     * @return ProductDiscountByIdGetRequest
     */
    public function getById($id)
    {
        return ProductDiscountByIdGetRequest::ofId($id);
    }
}
