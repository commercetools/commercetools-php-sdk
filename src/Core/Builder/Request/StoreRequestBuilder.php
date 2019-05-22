<?php
// phpcs:disable Generic.Files.LineLength
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\Stores\StoreByIdGetRequest;
use Commercetools\Core\Request\Stores\StoreByKeyGetRequest;
use Commercetools\Core\Request\Stores\StoreCreateRequest;
use Commercetools\Core\Model\Store\StoreDraft;
use Commercetools\Core\Request\Stores\StoreDeleteByKeyRequest;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Request\Stores\StoreDeleteRequest;
use Commercetools\Core\Request\Stores\StoreQueryRequest;
use Commercetools\Core\Request\Stores\StoreUpdateByKeyRequest;
use Commercetools\Core\Request\Stores\StoreUpdateRequest;

class StoreRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-stores#get-a-store-by-id
     * @param string $id
     * @return StoreByIdGetRequest
     */
    public function getById($id)
    {
        $request = StoreByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-stores#get-a-store-by-key
     * @param string $key
     * @return StoreByKeyGetRequest
     */
    public function getByKey($key)
    {
        $request = StoreByKeyGetRequest::ofKey($key);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-stores#create-a-store
     * @param StoreDraft $store
     * @return StoreCreateRequest
     */
    public function create(StoreDraft $store)
    {
        $request = StoreCreateRequest::ofDraft($store);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-stores#delete-store-by-key
     * @param Store $store
     * @return StoreDeleteByKeyRequest
     */
    public function deleteByKey(Store $store)
    {
        $request = StoreDeleteByKeyRequest::ofKeyAndVersion($store->getKey(), $store->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-stores#delete-store-by-id
     * @param Store $store
     * @return StoreDeleteRequest
     */
    public function delete(Store $store)
    {
        $request = StoreDeleteRequest::ofIdAndVersion($store->getId(), $store->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-stores#query-stores
     *
     * @return StoreQueryRequest
     */
    public function query()
    {
        $request = StoreQueryRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-stores#update-store-by-key
     * @param Store $store
     * @return StoreUpdateByKeyRequest
     */
    public function updateByKey(Store $store)
    {
        $request = StoreUpdateByKeyRequest::ofKeyAndVersion($store->getKey(), $store->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-stores#update-store-by-id
     * @param Store $store
     * @return StoreUpdateRequest
     */
    public function update(Store $store)
    {
        $request = StoreUpdateRequest::ofIdAndVersion($store->getId(), $store->getVersion());
        return $request;
    }

    /**
     * @return StoreRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
