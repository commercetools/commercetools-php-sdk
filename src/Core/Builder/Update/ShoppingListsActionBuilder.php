<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetSlugAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetDeleteDaysAfterLastModificationAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetCustomerAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetTextLineItemDescriptionAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetCustomFieldAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetTextLineItemCustomTypeAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeNameAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetLineItemCustomFieldAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetDescriptionAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetTextLineItemCustomFieldAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListRemoveTextLineItemAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListRemoveLineItemAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeTextLineItemQuantityAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetCustomTypeAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeTextLineItemsOrderAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetKeyAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetLineItemCustomTypeAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeTextLineItemNameAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeLineItemQuantityAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListAddLineItemAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListAddTextLineItemAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeLineItemsOrderAction;

class ShoppingListsActionBuilder
{
    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-slug
     * @param array $data
     * @return ShoppingListSetSlugAction
     */
    public function setSlug(array $data = [])
    {
        return new ShoppingListSetSlugAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-deletedaysafterlastmodification
     * @param array $data
     * @return ShoppingListSetDeleteDaysAfterLastModificationAction
     */
    public function setDeleteDaysAfterLastModification(array $data = [])
    {
        return new ShoppingListSetDeleteDaysAfterLastModificationAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-customer
     * @param array $data
     * @return ShoppingListSetCustomerAction
     */
    public function setCustomer(array $data = [])
    {
        return new ShoppingListSetCustomerAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-textlineitem-description
     * @param array $data
     * @return ShoppingListSetTextLineItemDescriptionAction
     */
    public function setTextLineItemDescription(array $data = [])
    {
        return new ShoppingListSetTextLineItemDescriptionAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-customField
     * @param array $data
     * @return ShoppingListSetCustomFieldAction
     */
    public function setCustomField(array $data = [])
    {
        return new ShoppingListSetCustomFieldAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-textlineitem-custom-type
     * @param array $data
     * @return ShoppingListSetTextLineItemCustomTypeAction
     */
    public function setTextLineItemCustomType(array $data = [])
    {
        return new ShoppingListSetTextLineItemCustomTypeAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#change-name
     * @param array $data
     * @return ShoppingListChangeNameAction
     */
    public function changeName(array $data = [])
    {
        return new ShoppingListChangeNameAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-lineitem-customfield
     * @param array $data
     * @return ShoppingListSetLineItemCustomFieldAction
     */
    public function setLineItemCustomField(array $data = [])
    {
        return new ShoppingListSetLineItemCustomFieldAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#change-description
     * @param array $data
     * @return ShoppingListSetDescriptionAction
     */
    public function setDescription(array $data = [])
    {
        return new ShoppingListSetDescriptionAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-textlineitem-customfield
     * @param array $data
     * @return ShoppingListSetTextLineItemCustomFieldAction
     */
    public function setTextLineItemCustomField(array $data = [])
    {
        return new ShoppingListSetTextLineItemCustomFieldAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#remove-textlineitem
     * @param array $data
     * @return ShoppingListRemoveTextLineItemAction
     */
    public function removeTextLineItem(array $data = [])
    {
        return new ShoppingListRemoveTextLineItemAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#remove-lineitem
     * @param array $data
     * @return ShoppingListRemoveLineItemAction
     */
    public function removeLineItem(array $data = [])
    {
        return new ShoppingListRemoveLineItemAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#change-textlineitem-quantity
     * @param array $data
     * @return ShoppingListChangeTextLineItemQuantityAction
     */
    public function changeTextLineItemQuantity(array $data = [])
    {
        return new ShoppingListChangeTextLineItemQuantityAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-customType
     * @param array $data
     * @return ShoppingListSetCustomTypeAction
     */
    public function setCustomType(array $data = [])
    {
        return new ShoppingListSetCustomTypeAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#change-textlineitems-order
     * @param array $data
     * @return ShoppingListChangeTextLineItemsOrderAction
     */
    public function changeTextLineItemsOrder(array $data = [])
    {
        return new ShoppingListChangeTextLineItemsOrderAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-key
     * @param array $data
     * @return ShoppingListSetKeyAction
     */
    public function setKey(array $data = [])
    {
        return new ShoppingListSetKeyAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-lineitem-custom-type
     * @param array $data
     * @return ShoppingListSetLineItemCustomTypeAction
     */
    public function setLineItemCustomType(array $data = [])
    {
        return new ShoppingListSetLineItemCustomTypeAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#change-textlineitem-name
     * @param array $data
     * @return ShoppingListChangeTextLineItemNameAction
     */
    public function changeTextLineItemName(array $data = [])
    {
        return new ShoppingListChangeTextLineItemNameAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#change-lineitem-quantity
     * @param array $data
     * @return ShoppingListChangeLineItemQuantityAction
     */
    public function changeLineItemQuantity(array $data = [])
    {
        return new ShoppingListChangeLineItemQuantityAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#add-lineitem
     * @param array $data
     * @return ShoppingListAddLineItemAction
     */
    public function addLineItem(array $data = [])
    {
        return new ShoppingListAddLineItemAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#add-textlineitem
     * @param array $data
     * @return ShoppingListAddTextLineItemAction
     */
    public function addTextLineItem(array $data = [])
    {
        return new ShoppingListAddTextLineItemAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#change-lineitems-order
     * @param array $data
     * @return ShoppingListChangeLineItemsOrderAction
     */
    public function changeLineItemsOrder(array $data = [])
    {
        return new ShoppingListChangeLineItemsOrderAction($data);
    }

    /**
     * @return ShoppingListsActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
