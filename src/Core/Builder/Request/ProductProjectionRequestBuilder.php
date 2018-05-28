<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\Products\ProductProjectionByIdGetRequest;
use Commercetools\Core\Request\Products\ProductProjectionByKeyGetRequest;
use Commercetools\Core\Request\Products\ProductProjectionBySkuGetRequest;
use Commercetools\Core\Request\Products\ProductProjectionBySlugGetRequest;
use Commercetools\Core\Request\Products\ProductProjectionQueryRequest;
use Commercetools\Core\Request\Products\ProductProjectionSearchRequest;
use Commercetools\Core\Request\Products\ProductsSuggestRequest;

class ProductProjectionRequestBuilder
{
    /**
     * @param bool $staged
     * @return ProductProjectionQueryRequest
     */
    public function query($staged = false)
    {
        return ProductProjectionQueryRequest::of()->staged($staged);
    }

    /**
     * @param bool $staged
     * @return ProductProjectionSearchRequest
     */
    public function search($staged = false)
    {
        return ProductProjectionSearchRequest::of()->staged($staged);
    }

    /**
     * @param string $id
     * @param bool $staged
     * @return ProductProjectionByIdGetRequest
     */
    public function getById($id, $staged = false)
    {
        return ProductProjectionByIdGetRequest::ofId($id)->staged($staged);
    }

    /**
     * @param string $key
     * @param bool $staged
     * @return ProductProjectionByKeyGetRequest
     */
    public function getByKey($key, $staged = false)
    {
        return ProductProjectionByKeyGetRequest::ofKey($key)->staged($staged);
    }

    /**
     * @param string $sku
     * @param bool $staged
     * @return ProductProjectionBySkuGetRequest
     */
    public function getBySku($sku, $staged = false)
    {
        return ProductProjectionBySkuGetRequest::ofSku($sku)->staged($staged);
    }

    /**
     * @param string $slug
     * @param array $languages
     * @param bool $staged
     * @return ProductProjectionBySlugGetRequest
     */
    public function getBySlug($slug, array $languages, $staged = false)
    {
        return ProductProjectionBySlugGetRequest::ofSlugAndLanguages($slug, $languages)->staged($staged);
    }

    /**
     * @param LocalizedString $keywords
     * @return ProductsSuggestRequest
     */
    public function suggest(LocalizedString $keywords)
    {
        return ProductsSuggestRequest::ofKeywords($keywords);
    }
}
