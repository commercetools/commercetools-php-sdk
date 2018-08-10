<?php
// phpcs:disable Generic.Files.LineLength
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\Products\ProductProjectionByIdGetRequest;
use Commercetools\Core\Request\Products\ProductProjectionByKeyGetRequest;
use Commercetools\Core\Request\Products\ProductProjectionBySkuGetRequest;
use Commercetools\Core\Request\Products\ProductProjectionBySlugGetRequest;
use Commercetools\Core\Request\Products\ProductProjectionQueryRequest;
use Commercetools\Core\Request\Products\ProductProjectionSearchRequest;
use Commercetools\Core\Request\Products\ProductsSuggestRequest;
use Commercetools\Core\Model\Common\LocalizedString;

class ProductProjectionRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-productProjections.html#get-productprojection-by-id
     * @param string $id
     * @param bool $staged
     * @return ProductProjectionByIdGetRequest
     */
    public function getById($id, $staged = false)
    {
        $request = ProductProjectionByIdGetRequest::ofId($id)->staged($staged);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productProjections.html#get-productprojection-by-key
     * @param string $key
     * @param bool $staged
     * @return ProductProjectionByKeyGetRequest
     */
    public function getByKey($key, $staged = false)
    {
        $request = ProductProjectionByKeyGetRequest::ofKey($key)->staged($staged);
        return $request;
    }

    /**
     *
     * @param string $sku
     * @param bool $staged
     * @return ProductProjectionBySkuGetRequest
     */
    public function getBySku($sku, $staged = false)
    {
        $request = ProductProjectionBySkuGetRequest::ofSku($sku)->staged($staged);
        return $request;
    }

    /**
     *
     * @param string $slug
     * @param array $languages
     * @param bool $staged
     * @return ProductProjectionBySlugGetRequest
     */
    public function getBySlug($slug, array $languages, $staged = false)
    {
        $request = ProductProjectionBySlugGetRequest::ofSlugAndLanguages($slug, $languages)->staged($staged);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#query-productprojections
     * @param bool $staged
     * @return ProductProjectionQueryRequest
     */
    public function query($staged = false)
    {
        $request = ProductProjectionQueryRequest::of()->staged($staged);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products-search.html#search-productprojections
     * @param bool $staged
     * @return ProductProjectionSearchRequest
     */
    public function search($staged = false)
    {
        $request = ProductProjectionSearchRequest::of()->staged($staged);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products-suggestions.html#suggest-query
     * @param LocalizedString $keywords
     * @param bool $staged
     * @return ProductsSuggestRequest
     */
    public function suggest(LocalizedString $keywords, $staged = false)
    {
        $request = ProductsSuggestRequest::ofKeywords($keywords)->staged($staged);
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
