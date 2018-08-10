<?php
// phpcs:ignoreFile
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\ProductTypes\ProductTypeByIdGetRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeByKeyGetRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeCreateRequest;
use Commercetools\Core\Model\ProductType\ProductTypeDraft;
use Commercetools\Core\Request\ProductTypes\ProductTypeDeleteByKeyRequest;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Request\ProductTypes\ProductTypeDeleteRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeQueryRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeUpdateByKeyRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeUpdateRequest;

class ProductTypeRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#get-a-producttype-by-id
     * @param string $id
     * @return ProductTypeByIdGetRequest
     */
    public function getById($id)
    {
        $request = ProductTypeByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#get-a-producttype-by-key
     * @param string $key
     * @return ProductTypeByKeyGetRequest
     */
    public function getByKey($key)
    {
        $request = ProductTypeByKeyGetRequest::ofKey($key);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#create-a-producttype
     * @param ProductTypeDraft $productType
     * @return ProductTypeCreateRequest
     */
    public function create(ProductTypeDraft $productType)
    {
        $request = ProductTypeCreateRequest::ofDraft($productType);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#delete-producttype-by-key
     * @param ProductType $productType
     * @return ProductTypeDeleteByKeyRequest
     */
    public function deleteByKey(ProductType $productType)
    {
        $request = ProductTypeDeleteByKeyRequest::ofKeyAndVersion($productType->getKey(), $productType->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#delete-producttype-by-id
     * @param ProductType $productType
     * @return ProductTypeDeleteRequest
     */
    public function delete(ProductType $productType)
    {
        $request = ProductTypeDeleteRequest::ofIdAndVersion($productType->getId(), $productType->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#query-producttypes
     * @param 
     * @return ProductTypeQueryRequest
     */
    public function query()
    {
        $request = ProductTypeQueryRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#update-producttype-by-key
     * @param ProductType $productType
     * @return ProductTypeUpdateByKeyRequest
     */
    public function updateByKey(ProductType $productType)
    {
        $request = ProductTypeUpdateByKeyRequest::ofKeyAndVersion($productType->getKey(), $productType->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#update-producttype-by-id
     * @param ProductType $productType
     * @return ProductTypeUpdateRequest
     */
    public function update(ProductType $productType)
    {
        $request = ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion());
        return $request;
    }

    /**
     * @return ProductTypeRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
