<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\TaxCategory\TaxCategoryDraft;
use Commercetools\Core\Request\TaxCategories\TaxCategoryByIdGetRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryByKeyGetRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryCreateRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryDeleteRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryQueryRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryUpdateRequest;

class TaxCategoryRequestBuilder
{
    /**
     * @return TaxCategoryQueryRequest
     */
    public function query()
    {
        return TaxCategoryQueryRequest::of();
    }

    /**
     * @param TaxCategory $taxCategory
     * @return TaxCategoryUpdateRequest
     */
    public function update(TaxCategory $taxCategory)
    {
        return TaxCategoryUpdateRequest::ofIdAndVersion($taxCategory->getId(), $taxCategory->getVersion());
    }

    /**
     * @param TaxCategoryDraft $taxCategoryDraft
     * @return TaxCategoryCreateRequest
     */
    public function create(TaxCategoryDraft $taxCategoryDraft)
    {
        return TaxCategoryCreateRequest::ofDraft($taxCategoryDraft);
    }

    /**
     * @param TaxCategory $taxCategory
     * @return TaxCategoryDeleteRequest
     */
    public function delete(TaxCategory $taxCategory)
    {
        return TaxCategoryDeleteRequest::ofIdAndVersion($taxCategory->getId(), $taxCategory->getVersion());
    }

    /**
     * @param $id
     * @return TaxCategoryByIdGetRequest
     */
    public function getById($id)
    {
        return TaxCategoryByIdGetRequest::ofId($id);
    }

    /**
     * @param $key
     * @return TaxCategoryByKeyGetRequest
     */
    public function getByKey($key)
    {
        return TaxCategoryByKeyGetRequest::ofKey($key);
    }
}
