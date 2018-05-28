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
use Commercetools\Core\Request\Products\ProductDeleteByKeyRequest;
use Commercetools\Core\Request\Products\ProductDeleteRequest;
use Commercetools\Core\Request\Products\ProductImageUploadRequest;
use Commercetools\Core\Request\Products\ProductQueryRequest;
use Commercetools\Core\Request\Products\ProductUpdateByKeyRequest;
use Commercetools\Core\Request\Products\ProductUpdateRequest;
use Psr\Http\Message\UploadedFileInterface;

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
     * @param Product $product
     * @return ProductUpdateByKeyRequest
     */
    public function updateByKey(Product $product)
    {
        return ProductUpdateByKeyRequest::ofKeyAndVersion($product->getKey(), $product->getVersion());
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
     * @param Product $product
     * @return ProductDeleteByKeyRequest
     */
    public function deleteByKey(Product $product)
    {
        return ProductDeleteByKeyRequest::ofKeyAndVersion($product->getKey(), $product->getVersion());
    }

    /**
     * @param string $id
     * @return ProductByIdGetRequest
     */
    public function getById($id)
    {
        return ProductByIdGetRequest::ofId($id);
    }

    /**
     * @param string $key
     * @return ProductByKeyGetRequest
     */
    public function getByKey($key)
    {
        return ProductByKeyGetRequest::ofKey($key);
    }

    /**
     * @param $id
     * @param $sku
     * @param UploadedFileInterface $uploadedFile
     * @return ProductImageUploadRequest
     */
    public function uploadImageBySKU($id, $sku, UploadedFileInterface $uploadedFile)
    {
        return ProductImageUploadRequest::ofIdSkuAndFile($id, $sku, $uploadedFile);
    }
}
