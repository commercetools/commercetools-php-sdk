<?php
// phpcs:disable Generic.Files.LineLength
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\ProductSelections\ProductSelectionAssignmentsQueryRequest;
use Commercetools\Core\Request\ProductSelections\ProductSelectionByIdGetRequest;
use Commercetools\Core\Request\ProductSelections\ProductSelectionByIdProductsGetRequest;
use Commercetools\Core\Request\ProductSelections\ProductSelectionByKeyGetRequest;
use Commercetools\Core\Request\ProductSelections\ProductSelectionByKeyProductsGetRequest;
use Commercetools\Core\Request\ProductSelections\ProductSelectionCreateRequest;
use Commercetools\Core\Model\ProductSelection\ProductSelectionDraft;
use Commercetools\Core\Request\ProductSelections\ProductSelectionDeleteByKeyRequest;
use Commercetools\Core\Model\ProductSelection\ProductSelection;
use Commercetools\Core\Request\ProductSelections\ProductSelectionDeleteRequest;
use Commercetools\Core\Request\ProductSelections\ProductSelectionQueryRequest;
use Commercetools\Core\Request\ProductSelections\ProductSelectionUpdateByKeyRequest;
use Commercetools\Core\Request\ProductSelections\ProductSelectionUpdateRequest;

class ProductSelectionRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/api/projects/product-selections#query-products-available-in-a-store-through-active-product-selections
     *
     * @return ProductSelectionAssignmentsQueryRequest
     */
    public function assignmentsQuery()
    {
        $request = ProductSelectionAssignmentsQueryRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/api/projects/product-selections#get-product-selection-by-id
     * @param string $id
     * @return ProductSelectionByIdGetRequest
     */
    public function getById($id)
    {
        $request = ProductSelectionByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/api/projects/product-selections#by-id
     * @param string $idProducts
     * @return ProductSelectionByIdProductsGetRequest
     */
    public function getByIdProducts($idProducts)
    {
        $request = ProductSelectionByIdProductsGetRequest::ofIdProducts($idProducts);
        return $request;
    }

    /**
     *
     * @param string $key
     * @return ProductSelectionByKeyGetRequest
     */
    public function getByKey($key)
    {
        $request = ProductSelectionByKeyGetRequest::ofKey($key);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/api/projects/product-selections#by-key
     * @param string $keyProducts
     * @return ProductSelectionByKeyProductsGetRequest
     */
    public function getByKeyProducts($keyProducts)
    {
        $request = ProductSelectionByKeyProductsGetRequest::ofKeyProducts($keyProducts);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/api/projects/product-selections#create-product-selection
     * @param ProductSelectionDraft $productSelection
     * @return ProductSelectionCreateRequest
     */
    public function create(ProductSelectionDraft $productSelection)
    {
        $request = ProductSelectionCreateRequest::ofDraft($productSelection);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/api/projects/product-selections#delete-product-selection-by-key
     * @param ProductSelection $productSelection
     * @return ProductSelectionDeleteByKeyRequest
     */
    public function deleteByKey(ProductSelection $productSelection)
    {
        $request = ProductSelectionDeleteByKeyRequest::ofKeyAndVersion($productSelection->getKey(), $productSelection->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/api/projects/product-selections#delete-product-selection-by-id
     * @param ProductSelection $productSelection
     * @return ProductSelectionDeleteRequest
     */
    public function delete(ProductSelection $productSelection)
    {
        $request = ProductSelectionDeleteRequest::ofIdAndVersion($productSelection->getId(), $productSelection->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/api/projects/product-selections#query-product-selections
     *
     * @return ProductSelectionQueryRequest
     */
    public function query()
    {
        $request = ProductSelectionQueryRequest::of();
        return $request;
    }

    /**
     *
     * @param ProductSelection $productSelection
     * @return ProductSelectionUpdateByKeyRequest
     */
    public function updateByKey(ProductSelection $productSelection)
    {
        $request = ProductSelectionUpdateByKeyRequest::ofKeyAndVersion($productSelection->getKey(), $productSelection->getVersion());
        return $request;
    }

    /**
     *
     * @param ProductSelection $productSelection
     * @return ProductSelectionUpdateRequest
     */
    public function update(ProductSelection $productSelection)
    {
        $request = ProductSelectionUpdateRequest::ofIdAndVersion($productSelection->getId(), $productSelection->getVersion());
        return $request;
    }

    /**
     * @return ProductSelectionRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
