<?php
/**
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Model\ShoppingList\MyShoppingListDraft;
use Commercetools\Core\Model\ShoppingList\ShoppingList;
use Commercetools\Core\Request\Me\MeShoppingListByIdGetRequest;
use Commercetools\Core\Request\Me\MeShoppingListByKeyGetRequest;
use Commercetools\Core\Request\Me\MeShoppingListCreateRequest;
use Commercetools\Core\Request\Me\MeShoppingListDeleteByKeyRequest;
use Commercetools\Core\Request\Me\MeShoppingListDeleteRequest;
use Commercetools\Core\Request\Me\MeShoppingListQueryRequest;
use Commercetools\Core\Request\Me\MeShoppingListUpdateByKeyRequest;
use Commercetools\Core\Request\Me\MeShoppingListUpdateRequest;

class MeShoppingListRequestBuilder
{
    /**
     * @return MeShoppingListQueryRequest
     */
    public function query()
    {
        return MeShoppingListQueryRequest::of();
    }

    /**
     * @param ShoppingList $shoppingList
     * @return MeShoppingListUpdateRequest
     */
    public function update(ShoppingList $shoppingList)
    {
        return MeShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion());
    }

    /**
     * @param ShoppingList $shoppingList
     * @return MeShoppingListUpdateByKeyRequest
     */
    public function updateByKey(ShoppingList $shoppingList)
    {
        return MeShoppingListUpdateByKeyRequest::ofKeyAndVersion($shoppingList->getKey(), $shoppingList->getVersion());
    }

    /**
     * @param string $shoppingListId
     * @return MeShoppingListByIdGetRequest
     */
    public function getById($shoppingListId)
    {
        return MeShoppingListByIdGetRequest::ofId($shoppingListId);
    }

    /**
     * @param string $shoppingListKey
     * @return MeShoppingListByKeyGetRequest
     */
    public function getByKey($shoppingListKey)
    {
        return MeShoppingListByKeyGetRequest::ofKey($shoppingListKey);
    }

    /**
     * @param MyShoppingListDraft $myShoppingListDraft
     * @return MeShoppingListCreateRequest
     */
    public function create(MyShoppingListDraft $myShoppingListDraft)
    {
        return MeShoppingListCreateRequest::ofDraft($myShoppingListDraft);
    }

    /**
     * @param ShoppingList $shoppingList
     * @return MeShoppingListDeleteRequest
     */
    public function delete(ShoppingList $shoppingList)
    {
        return MeShoppingListDeleteRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion());
    }

    /**
     * @param ShoppingList $shoppingList
     * @return MeShoppingListDeleteByKeyRequest
     */
    public function deleteByKey(ShoppingList $shoppingList)
    {
        return MeShoppingListDeleteByKeyRequest::ofKeyAndVersion($shoppingList->getKey(), $shoppingList->getVersion());
    }
}
