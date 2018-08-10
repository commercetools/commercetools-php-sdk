<?php
// phpcs:ignoreFile
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\ShoppingLists\ShoppingListByIdGetRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListByKeyGetRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListCreateRequest;
use Commercetools\Core\Model\ShoppingList\ShoppingListDraft;
use Commercetools\Core\Request\ShoppingLists\ShoppingListDeleteByKeyRequest;
use Commercetools\Core\Model\ShoppingList\ShoppingList;
use Commercetools\Core\Request\ShoppingLists\ShoppingListDeleteRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListQueryRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListUpdateByKeyRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListUpdateRequest;

class ShoppingListRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#get-shoppingList-by-id
     * @param string $id
     * @return ShoppingListByIdGetRequest
     */
    public function getById($id)
    {
        $request = ShoppingListByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     *
     * @param string $key
     * @return ShoppingListByKeyGetRequest
     */
    public function getByKey($key)
    {
        $request = ShoppingListByKeyGetRequest::ofKey($key);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#create-ShoppingList
     * @param ShoppingListDraft $ShoppingList
     * @return ShoppingListCreateRequest
     */
    public function create(ShoppingListDraft $ShoppingList)
    {
        $request = ShoppingListCreateRequest::ofDraft($ShoppingList);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-ShoppingLists.html#delete-ShoppingList-by-key
     * @param ShoppingList $shoppingList
     * @return ShoppingListDeleteByKeyRequest
     */
    public function deleteByKey(ShoppingList $shoppingList)
    {
        $request = ShoppingListDeleteByKeyRequest::ofKeyAndVersion($shoppingList->getKey(), $shoppingList->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-ShoppingLists.html#delete-ShoppingList-by-id
     * @param ShoppingList $shoppingList
     * @return ShoppingListDeleteRequest
     */
    public function delete(ShoppingList $shoppingList)
    {
        $request = ShoppingListDeleteRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-ShoppingLists.html#query-ShoppingLists
     * @param 
     * @return ShoppingListQueryRequest
     */
    public function query()
    {
        $request = ShoppingListQueryRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-ShoppingLists.html#update-ShoppingList-by-key
     * @param ShoppingList $shoppingList
     * @return ShoppingListUpdateByKeyRequest
     */
    public function updateByKey(ShoppingList $shoppingList)
    {
        $request = ShoppingListUpdateByKeyRequest::ofKeyAndVersion($shoppingList->getKey(), $shoppingList->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-ShoppingLists.html#update-ShoppingList-by-id
     * @param ShoppingList $shoppingList
     * @return ShoppingListUpdateRequest
     */
    public function update(ShoppingList $shoppingList)
    {
        $request = ShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion());
        return $request;
    }

    /**
     * @return ShoppingListRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
