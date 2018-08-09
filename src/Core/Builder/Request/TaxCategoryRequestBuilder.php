<?php

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\TaxCategories\TaxCategoryByIdGetRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryByKeyGetRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryCreateRequest;
use Commercetools\Core\Model\TaxCategory\TaxCategoryDraft;
use Commercetools\Core\Request\TaxCategories\TaxCategoryDeleteByKeyRequest;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Request\TaxCategories\TaxCategoryDeleteRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryQueryRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryUpdateByKeyRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryUpdateRequest;

class TaxCategoryRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-taxCategories.html#get-taxcategory-by-id
     * @param string $id
     * @return TaxCategoryByIdGetRequest
     */
    public function getById($id)
    {
        $request = TaxCategoryByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     *
     * @param string $key
     * @return TaxCategoryByKeyGetRequest
     */
    public function getByKey($key)
    {
        $request = TaxCategoryByKeyGetRequest::ofKey($key);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-taxCategories.html#create-taxcategory
     * @param TaxCategoryDraft $taxCategory
     * @return TaxCategoryCreateRequest
     */
    public function create(TaxCategoryDraft $taxCategory)
    {
        $request = TaxCategoryCreateRequest::ofDraft($taxCategory);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-taxCategories.html#delete-taxcategory
     * @param TaxCategory $taxCategory
     * @return TaxCategoryDeleteByKeyRequest
     */
    public function deleteByKey(TaxCategory $taxCategory)
    {
        $request = TaxCategoryDeleteByKeyRequest::ofKeyAndVersion($taxCategory->getKey(), $taxCategory->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-taxCategories.html#delete-taxcategory
     * @param TaxCategory $taxCategory
     * @return TaxCategoryDeleteRequest
     */
    public function delete(TaxCategory $taxCategory)
    {
        $request = TaxCategoryDeleteRequest::ofIdAndVersion($taxCategory->getId(), $taxCategory->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-taxCategories.html#query-taxcategories
     * @param 
     * @return TaxCategoryQueryRequest
     */
    public function query()
    {
        $request = TaxCategoryQueryRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-taxCategories.html#update-taxcategory
     * @param TaxCategory $taxCategory
     * @return TaxCategoryUpdateByKeyRequest
     */
    public function updateByKey(TaxCategory $taxCategory)
    {
        $request = TaxCategoryUpdateByKeyRequest::ofKeyAndVersion($taxCategory->getKey(), $taxCategory->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-taxCategories.html#update-taxcategory
     * @param TaxCategory $taxCategory
     * @return TaxCategoryUpdateRequest
     */
    public function update(TaxCategory $taxCategory)
    {
        $request = TaxCategoryUpdateRequest::ofIdAndVersion($taxCategory->getId(), $taxCategory->getVersion());
        return $request;
    }

    /**
     * @return TaxCategoryRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
