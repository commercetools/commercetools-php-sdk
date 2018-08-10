<?php
// phpcs:disable Generic.Files.LineLength
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\Products\ProductByIdGetRequest;
use Commercetools\Core\Request\Products\ProductByKeyGetRequest;
use Commercetools\Core\Request\Products\ProductCreateRequest;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Request\Products\ProductDeleteByKeyRequest;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Request\Products\ProductDeleteRequest;
use Commercetools\Core\Request\Products\ProductImageUploadRequest;
use Psr\Http\Message\UploadedFileInterface;
use Commercetools\Core\Request\Products\ProductQueryRequest;
use Commercetools\Core\Request\Products\ProductUpdateByKeyRequest;
use Commercetools\Core\Request\Products\ProductUpdateRequest;

class ProductRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#get-product-by-id
     * @param string $id
     * @return ProductByIdGetRequest
     */
    public function getById($id)
    {
        $request = ProductByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     *
     * @param string $key
     * @return ProductByKeyGetRequest
     */
    public function getByKey($key)
    {
        $request = ProductByKeyGetRequest::ofKey($key);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#create-a-product
     * @param ProductDraft $product
     * @return ProductCreateRequest
     */
    public function create(ProductDraft $product)
    {
        $request = ProductCreateRequest::ofDraft($product);
        return $request;
    }

    /**
     *
     * @param Product $product
     * @return ProductDeleteByKeyRequest
     */
    public function deleteByKey(Product $product)
    {
        $request = ProductDeleteByKeyRequest::ofKeyAndVersion($product->getKey(), $product->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#delete-product
     * @param Product $product
     * @return ProductDeleteRequest
     */
    public function delete(Product $product)
    {
        $request = ProductDeleteRequest::ofIdAndVersion($product->getId(), $product->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#upload-a-product-image
     * @param string $id
     * @param string $sku
     * @param UploadedFileInterface $uploadedFile
     * @return ProductImageUploadRequest
     */
    public function uploadImageBySKU($id, $sku, UploadedFileInterface $uploadedFile)
    {
        $request = ProductImageUploadRequest::ofIdSkuAndFile($id, $sku, $uploadedFile);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#query-products
     *
     * @return ProductQueryRequest
     */
    public function query()
    {
        $request = ProductQueryRequest::of();
        return $request;
    }

    /**
     *
     * @param Product $product
     * @return ProductUpdateByKeyRequest
     */
    public function updateByKey(Product $product)
    {
        $request = ProductUpdateByKeyRequest::ofKeyAndVersion($product->getKey(), $product->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#update-product
     * @param Product $product
     * @return ProductUpdateRequest
     */
    public function update(Product $product)
    {
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion());
        return $request;
    }

    /**
     * @return ProductRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
