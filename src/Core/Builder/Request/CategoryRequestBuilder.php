<?php
// phpcs:ignoreFile
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\Categories\CategoryByIdGetRequest;
use Commercetools\Core\Request\Categories\CategoryByKeyGetRequest;
use Commercetools\Core\Request\Categories\CategoryCreateRequest;
use Commercetools\Core\Model\Category\CategoryDraft;
use Commercetools\Core\Request\Categories\CategoryDeleteByKeyRequest;
use Commercetools\Core\Model\Category\Category;
use Commercetools\Core\Request\Categories\CategoryDeleteRequest;
use Commercetools\Core\Request\Categories\CategoryQueryRequest;
use Commercetools\Core\Request\Categories\CategoryUpdateByKeyRequest;
use Commercetools\Core\Request\Categories\CategoryUpdateRequest;

class CategoryRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#get-category-by-id
     * @param string $id
     * @return CategoryByIdGetRequest
     */
    public function getById($id)
    {
        $request = CategoryByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#get-category-by-key
     * @param string $key
     * @return CategoryByKeyGetRequest
     */
    public function getByKey($key)
    {
        $request = CategoryByKeyGetRequest::ofKey($key);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#create-a-category
     * @param CategoryDraft $category
     * @return CategoryCreateRequest
     */
    public function create(CategoryDraft $category)
    {
        $request = CategoryCreateRequest::ofDraft($category);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#delete-category
     * @param Category $category
     * @return CategoryDeleteByKeyRequest
     */
    public function deleteByKey(Category $category)
    {
        $request = CategoryDeleteByKeyRequest::ofKeyAndVersion($category->getKey(), $category->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#delete-category
     * @param Category $category
     * @return CategoryDeleteRequest
     */
    public function delete(Category $category)
    {
        $request = CategoryDeleteRequest::ofIdAndVersion($category->getId(), $category->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#query-categories
     * @param 
     * @return CategoryQueryRequest
     */
    public function query()
    {
        $request = CategoryQueryRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#update-category
     * @param Category $category
     * @return CategoryUpdateByKeyRequest
     */
    public function updateByKey(Category $category)
    {
        $request = CategoryUpdateByKeyRequest::ofKeyAndVersion($category->getKey(), $category->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#update-category
     * @param Category $category
     * @return CategoryUpdateRequest
     */
    public function update(Category $category)
    {
        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion());
        return $request;
    }

    /**
     * @return CategoryRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
