<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Request\Products\ProductByIdGetRequest;
use Commercetools\Core\Request\Products\ProductByKeyGetRequest;
use Commercetools\Core\Request\Products\ProductCreateRequest;
use Commercetools\Core\Request\Products\ProductDeleteRequest;
use Commercetools\Core\Request\Products\ProductQueryRequest;
use Commercetools\Core\Request\Products\ProductUpdateRequest;

class ProductRequestBuilder
{
    /**
     * @return ProductQueryRequest
     */
    public function query()
    {
        return ProductQueryRequest::of();
    }

    /**
     * @param Product $product
     * @return ProductUpdateRequest
     */
    public function update(Product $product)
    {
        return ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion());
    }

    /**
     * @param ProductDraft $productDraft
     * @return ProductCreateRequest
     */
    public function create(ProductDraft $productDraft)
    {
        return ProductCreateRequest::ofDraft($productDraft);
    }

    /**
     * @param Product $product
     * @return ProductDeleteRequest
     */
    public function delete(Product $product)
    {
        return ProductDeleteRequest::ofIdAndVersion($product->getId(), $product->getVersion());
    }

    /**
     * @param $id
     * @return ProductByIdGetRequest
     */
    public function getById($id)
    {
        return ProductByIdGetRequest::ofId($id);
    }

    /**
     * @param $key
     * @return ProductByKeyGetRequest
     */
    public function getByKey($key)
    {
        return ProductByKeyGetRequest::ofKey($key);
    }
}
