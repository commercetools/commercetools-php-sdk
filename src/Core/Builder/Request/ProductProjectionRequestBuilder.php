<?php

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\Products\ProductProjectionByIdGetRequest;
use Commercetools\Core\Request\Products\ProductProjectionByKeyGetRequest;
use Commercetools\Core\Request\Products\ProductProjectionBySkuGetRequest;
use Commercetools\Core\Request\Products\ProductProjectionBySlugGetRequest;
use Commercetools\Core\Request\Products\ProductProjectionQueryRequest;
use Commercetools\Core\Request\Products\ProductProjectionSearchRequest;

class ProductProjectionRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-productProjections.html#get-productprojection-by-id
     * @param string $id
     * @return ProductProjectionByIdGetRequest
     */
    public function getById($id)
    {
        $request = ProductProjectionByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productProjections.html#get-productprojection-by-key
     * @param string $key
     * @return ProductProjectionByKeyGetRequest
     */
    public function getByKey($key)
    {
        $request = ProductProjectionByKeyGetRequest::ofKey($key);
        return $request;
    }

    /**
     *
     * @param string $sku
     * @return ProductProjectionBySkuGetRequest
     */
    public function getBySku($sku)
    {
        $request = ProductProjectionBySkuGetRequest::ofSku($sku);
        return $request;
    }

    /**
     *
     * @param string $slug
     * @param array $languages
     * @param string $staged
     * @return ProductProjectionBySlugGetRequest
     */
    public function getBySlug($slug, array $languages, $staged = false)
    {
        $request = ProductProjectionBySlugGetRequest::ofSlugAndLanguages($slug, $languages)->staged($staged);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#query-productprojections
     * @param 
     * @return ProductProjectionQueryRequest
     */
    public function query()
    {
        $request = ProductProjectionQueryRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products-search.html#search-productprojections
     * @param 
     * @return ProductProjectionSearchRequest
     */
    public function search()
    {
        $request = ProductProjectionSearchRequest::of();
        return $request;
    }

    /**
     * @return ProductProjectionRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
