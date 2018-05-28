<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Model\Category\Category;
use Commercetools\Core\Model\Category\CategoryDraft;
use Commercetools\Core\Request\Categories\CategoryByIdGetRequest;
use Commercetools\Core\Request\Categories\CategoryByKeyGetRequest;
use Commercetools\Core\Request\Categories\CategoryCreateRequest;
use Commercetools\Core\Request\Categories\CategoryDeleteByKeyRequest;
use Commercetools\Core\Request\Categories\CategoryDeleteRequest;
use Commercetools\Core\Request\Categories\CategoryQueryRequest;
use Commercetools\Core\Request\Categories\CategoryUpdateByKeyRequest;
use Commercetools\Core\Request\Categories\CategoryUpdateRequest;

class CategoryRequestBuilder
{
    /**
     * @return CategoryQueryRequest
     */
    public function query()
    {
        return CategoryQueryRequest::of();
    }

    /**
     * @param Category $category
     * @return CategoryUpdateRequest
     */
    public function update(Category $category)
    {
        return CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion());
    }

    /**
     * @param Category $category
     * @return CategoryUpdateByKeyRequest
     */
    public function updateByKey(Category $category)
    {
        return CategoryUpdateByKeyRequest::ofKeyAndVersion($category->getKey(), $category->getVersion());
    }

    /**
     * @param CategoryDraft $categoryDraft
     * @return CategoryCreateRequest
     */
    public function create(CategoryDraft $categoryDraft)
    {
        return CategoryCreateRequest::ofDraft($categoryDraft);
    }

    /**
     * @param Category $category
     * @return CategoryDeleteRequest
     */
    public function delete(Category $category)
    {
        return CategoryDeleteRequest::ofIdAndVersion($category->getId(), $category->getVersion());
    }

    /**
     * @param Category $category
     * @return CategoryDeleteByKeyRequest
     */
    public function deleteByKey(Category $category)
    {
        return CategoryDeleteByKeyRequest::ofKeyAndVersion($category->getKey(), $category->getVersion());
    }

    /**
     * @param string $id
     * @return CategoryByIdGetRequest
     */
    public function getById($id)
    {
        return CategoryByIdGetRequest::ofId($id);
    }

    /**
     * @param string $key
     * @return CategoryByKeyGetRequest
     */
    public function getByKey($key)
    {
        return CategoryByKeyGetRequest::ofKey($key);
    }
}
