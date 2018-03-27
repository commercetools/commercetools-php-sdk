<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\ProductType\ProductTypeDraft;
use Commercetools\Core\Request\ProductTypes\ProductTypeByIdGetRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeByKeyGetRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeCreateRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeDeleteRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeQueryRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeUpdateRequest;

class ProductTypeRequestBuilder
{
    /**
     * @return ProductTypeQueryRequest
     */
    public function query()
    {
        return ProductTypeQueryRequest::of();
    }

    /**
     * @param ProductType $productType
     * @return ProductTypeUpdateRequest
     */
    public function update(ProductType $productType)
    {
        return ProductTypeUpdateRequest::ofIdAndVersion($productType->getId(), $productType->getVersion());
    }

    /**
     * @param ProductTypeDraft $productTypeDraft
     * @return ProductTypeCreateRequest
     */
    public function create(ProductTypeDraft $productTypeDraft)
    {
        return ProductTypeCreateRequest::ofDraft($productTypeDraft);
    }

    /**
     * @param ProductType $productType
     * @return ProductTypeDeleteRequest
     */
    public function delete(ProductType $productType)
    {
        return ProductTypeDeleteRequest::ofIdAndVersion($productType->getId(), $productType->getVersion());
    }

    /**
     * @param $id
     * @return ProductTypeByIdGetRequest
     */
    public function getById($id)
    {
        return ProductTypeByIdGetRequest::ofId($id);
    }

    /**
     * @param $key
     * @return ProductTypeByKeyGetRequest
     */
    public function getByKey($key)
    {
        return ProductTypeByKeyGetRequest::ofKey($key);
    }
}
