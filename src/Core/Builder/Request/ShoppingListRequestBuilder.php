<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Model\ShoppingList\ShoppingList;
use Commercetools\Core\Model\ShoppingList\ShoppingListDraft;
use Commercetools\Core\Request\ShoppingLists\ShoppingListByIdGetRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListByKeyGetRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListCreateRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListDeleteByKeyRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListDeleteRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListQueryRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListUpdateByKeyRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListUpdateRequest;

class ShoppingListRequestBuilder
{
    /**
     * @return ShoppingListQueryRequest
     */
    public function query()
    {
        return ShoppingListQueryRequest::of();
    }

    /**
     * @param ShoppingList $shoppingList
     * @return ShoppingListUpdateRequest
     */
    public function update(ShoppingList $shoppingList)
    {
        return ShoppingListUpdateRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion());
    }

    /**
     * @param ShoppingList $shoppingList
     * @return ShoppingListUpdateByKeyRequest
     */
    public function updateByKey(ShoppingList $shoppingList)
    {
        return ShoppingListUpdateByKeyRequest::ofKeyAndVersion($shoppingList->getKey(), $shoppingList->getVersion());
    }

    /**
     * @param ShoppingListDraft $shoppingListDraft
     * @return ShoppingListCreateRequest
     */
    public function create(ShoppingListDraft $shoppingListDraft)
    {
        return ShoppingListCreateRequest::ofDraft($shoppingListDraft);
    }

    /**
     * @param ShoppingList $shoppingList
     * @return ShoppingListDeleteRequest
     */
    public function delete(ShoppingList $shoppingList)
    {
        return ShoppingListDeleteRequest::ofIdAndVersion($shoppingList->getId(), $shoppingList->getVersion());
    }

    /**
     * @param ShoppingList $shoppingList
     * @return ShoppingListDeleteByKeyRequest
     */
    public function deleteByKey(ShoppingList $shoppingList)
    {
        return ShoppingListDeleteByKeyRequest::ofKeyAndVersion($shoppingList->getKey(), $shoppingList->getVersion());
    }

    /**
     * @param string $id
     * @return ShoppingListByIdGetRequest
     */
    public function getById($id)
    {
        return ShoppingListByIdGetRequest::ofId($id);
    }

    /**
     * @param string $key
     * @return ShoppingListByKeyGetRequest
     */
    public function getByKey($key)
    {
        return ShoppingListByKeyGetRequest::ofKey($key);
    }
}
