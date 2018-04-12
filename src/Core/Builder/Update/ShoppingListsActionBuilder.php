<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListAddLineItemAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListAddTextLineItemAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeLineItemQuantityAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeLineItemsOrderAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeNameAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeTextLineItemNameAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeTextLineItemQuantityAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListChangeTextLineItemsOrderAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListRemoveLineItemAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListRemoveTextLineItemAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetCustomFieldAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetCustomTypeAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetCustomerAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetDeleteDaysAfterLastModificationAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetDescriptionAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetKeyAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetLineItemCustomFieldAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetLineItemCustomTypeAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetSlugAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetTextLineItemCustomFieldAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetTextLineItemCustomTypeAction;
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetTextLineItemDescriptionAction;

class ShoppingListsActionBuilder
{
    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#add-lineitem
     * @param array $data
     * @return ShoppingListAddLineItemAction
     */
    public function addLineItem(array $data = [])
    {
        return ShoppingListAddLineItemAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#add-textlineitem
     * @param array $data
     * @return ShoppingListAddTextLineItemAction
     */
    public function addTextLineItem(array $data = [])
    {
        return ShoppingListAddTextLineItemAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#change-lineitem-quantity
     * @param array $data
     * @return ShoppingListChangeLineItemQuantityAction
     */
    public function changeLineItemQuantity(array $data = [])
    {
        return ShoppingListChangeLineItemQuantityAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#change-lineitems-order
     * @param array $data
     * @return ShoppingListChangeLineItemsOrderAction
     */
    public function changeLineItemsOrder(array $data = [])
    {
        return ShoppingListChangeLineItemsOrderAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#change-name
     * @param array $data
     * @return ShoppingListChangeNameAction
     */
    public function changeName(array $data = [])
    {
        return ShoppingListChangeNameAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#change-textlineitem-name
     * @param array $data
     * @return ShoppingListChangeTextLineItemNameAction
     */
    public function changeTextLineItemName(array $data = [])
    {
        return ShoppingListChangeTextLineItemNameAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#change-textlineitem-quantity
     * @param array $data
     * @return ShoppingListChangeTextLineItemQuantityAction
     */
    public function changeTextLineItemQuantity(array $data = [])
    {
        return ShoppingListChangeTextLineItemQuantityAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#change-textlineitems-order
     * @param array $data
     * @return ShoppingListChangeTextLineItemsOrderAction
     */
    public function changeTextLineItemsOrder(array $data = [])
    {
        return ShoppingListChangeTextLineItemsOrderAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#remove-lineitem
     * @param array $data
     * @return ShoppingListRemoveLineItemAction
     */
    public function removeLineItem(array $data = [])
    {
        return ShoppingListRemoveLineItemAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#remove-textlineitem
     * @param array $data
     * @return ShoppingListRemoveTextLineItemAction
     */
    public function removeTextLineItem(array $data = [])
    {
        return ShoppingListRemoveTextLineItemAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-customField
     * @param array $data
     * @return ShoppingListSetCustomFieldAction
     */
    public function setCustomField(array $data = [])
    {
        return ShoppingListSetCustomFieldAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-customType
     * @param array $data
     * @return ShoppingListSetCustomTypeAction
     */
    public function setCustomType(array $data = [])
    {
        return ShoppingListSetCustomTypeAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-customer
     * @param array $data
     * @return ShoppingListSetCustomerAction
     */
    public function setCustomer(array $data = [])
    {
        return ShoppingListSetCustomerAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-deletedaysafterlastmodification
     * @param array $data
     * @return ShoppingListSetDeleteDaysAfterLastModificationAction
     */
    public function setDeleteDaysAfterLastModification(array $data = [])
    {
        return ShoppingListSetDeleteDaysAfterLastModificationAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#change-description
     * @param array $data
     * @return ShoppingListSetDescriptionAction
     */
    public function setDescription(array $data = [])
    {
        return ShoppingListSetDescriptionAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-key
     * @param array $data
     * @return ShoppingListSetKeyAction
     */
    public function setKey(array $data = [])
    {
        return ShoppingListSetKeyAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-lineitem-customfield
     * @param array $data
     * @return ShoppingListSetLineItemCustomFieldAction
     */
    public function setLineItemCustomField(array $data = [])
    {
        return ShoppingListSetLineItemCustomFieldAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-lineitem-custom-type
     * @param array $data
     * @return ShoppingListSetLineItemCustomTypeAction
     */
    public function setLineItemCustomType(array $data = [])
    {
        return ShoppingListSetLineItemCustomTypeAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-slug
     * @param array $data
     * @return ShoppingListSetSlugAction
     */
    public function setSlug(array $data = [])
    {
        return ShoppingListSetSlugAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-textlineitem-customfield
     * @param array $data
     * @return ShoppingListSetTextLineItemCustomFieldAction
     */
    public function setTextLineItemCustomField(array $data = [])
    {
        return ShoppingListSetTextLineItemCustomFieldAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-textlineitem-custom-type
     * @param array $data
     * @return ShoppingListSetTextLineItemCustomTypeAction
     */
    public function setTextLineItemCustomType(array $data = [])
    {
        return ShoppingListSetTextLineItemCustomTypeAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-textlineitem-description
     * @param array $data
     * @return ShoppingListSetTextLineItemDescriptionAction
     */
    public function setTextLineItemDescription(array $data = [])
    {
        return ShoppingListSetTextLineItemDescriptionAction::fromArray($data);
    }

    /**
     * @return ShoppingListsActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
