<?php
// phpcs:disable Generic.Files.LineLength
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\ProductDiscounts\ProductDiscountByIdGetRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountByKeyGetRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountCreateRequest;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountDraft;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountDeleteByKeyRequest;
use Commercetools\Core\Model\ProductDiscount\ProductDiscount;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountDeleteRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountMatchingRequest;
use Commercetools\Core\Model\Common\Price;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountQueryRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountUpdateByKeyRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountUpdateRequest;

class ProductDiscountRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#get-productdiscount-by-id
     * @param string $id
     * @return ProductDiscountByIdGetRequest
     */
    public function getById($id)
    {
        $request = ProductDiscountByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     *
     * @param string $key
     * @return ProductDiscountByKeyGetRequest
     */
    public function getByKey($key)
    {
        $request = ProductDiscountByKeyGetRequest::ofKey($key);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#create-a-productdiscount
     * @param ProductDiscountDraft $productDiscount
     * @return ProductDiscountCreateRequest
     */
    public function create(ProductDiscountDraft $productDiscount)
    {
        $request = ProductDiscountCreateRequest::ofDraft($productDiscount);
        return $request;
    }

    /**
     *
     * @param ProductDiscount $productDiscount
     * @return ProductDiscountDeleteByKeyRequest
     */
    public function deleteByKey(ProductDiscount $productDiscount)
    {
        $request = ProductDiscountDeleteByKeyRequest::ofKeyAndVersion($productDiscount->getKey(), $productDiscount->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#delete-productdiscount
     * @param ProductDiscount $productDiscount
     * @return ProductDiscountDeleteRequest
     */
    public function delete(ProductDiscount $productDiscount)
    {
        $request = ProductDiscountDeleteRequest::ofIdAndVersion($productDiscount->getId(), $productDiscount->getVersion());
        return $request;
    }

    /**
     *
     * @param string $productId
     * @param int $variantId
     * @param Price $price
     * @return ProductDiscountMatchingRequest
     */
    public function matching($productId, $variantId, Price $price)
    {
        $request = ProductDiscountMatchingRequest::ofProductIdVariantIdAndPrice($productId, $variantId, $price);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#query-productdiscounts
     *
     * @return ProductDiscountQueryRequest
     */
    public function query()
    {
        $request = ProductDiscountQueryRequest::of();
        return $request;
    }

    /**
     *
     * @param ProductDiscount $productDiscount
     * @return ProductDiscountUpdateByKeyRequest
     */
    public function updateByKey(ProductDiscount $productDiscount)
    {
        $request = ProductDiscountUpdateByKeyRequest::ofKeyAndVersion($productDiscount->getKey(), $productDiscount->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#update-productdiscount
     * @param ProductDiscount $productDiscount
     * @return ProductDiscountUpdateRequest
     */
    public function update(ProductDiscount $productDiscount)
    {
        $request = ProductDiscountUpdateRequest::ofIdAndVersion($productDiscount->getId(), $productDiscount->getVersion());
        return $request;
    }

    /**
     * @return ProductDiscountRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
