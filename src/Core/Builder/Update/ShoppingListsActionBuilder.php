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
     * @return ShoppingListSetSlugAction
     */
    public function setSlug()
    {
        return ShoppingListSetSlugAction::of();
    }

    /**
     * @return ShoppingListSetDeleteDaysAfterLastModificationAction
     */
    public function setDeleteDaysAfterLastModification()
    {
        return ShoppingListSetDeleteDaysAfterLastModificationAction::of();
    }

    /**
     * @return ShoppingListSetCustomerAction
     */
    public function setCustomer()
    {
        return ShoppingListSetCustomerAction::of();
    }

    /**
     * @return ShoppingListSetTextLineItemDescriptionAction
     */
    public function setTextLineItemDescription()
    {
        return ShoppingListSetTextLineItemDescriptionAction::of();
    }

    /**
     * @return ShoppingListSetCustomFieldAction
     */
    public function setCustomField()
    {
        return ShoppingListSetCustomFieldAction::of();
    }

    /**
     * @return ShoppingListSetTextLineItemCustomTypeAction
     */
    public function setTextLineItemCustomType()
    {
        return ShoppingListSetTextLineItemCustomTypeAction::of();
    }

    /**
     * @return ShoppingListChangeNameAction
     */
    public function changeName()
    {
        return ShoppingListChangeNameAction::of();
    }

    /**
     * @return ShoppingListSetLineItemCustomFieldAction
     */
    public function setLineItemCustomField()
    {
        return ShoppingListSetLineItemCustomFieldAction::of();
    }

    /**
     * @return ShoppingListSetDescriptionAction
     */
    public function setDescription()
    {
        return ShoppingListSetDescriptionAction::of();
    }

    /**
     * @return ShoppingListSetTextLineItemCustomFieldAction
     */
    public function setTextLineItemCustomField()
    {
        return ShoppingListSetTextLineItemCustomFieldAction::of();
    }

    /**
     * @return ShoppingListRemoveTextLineItemAction
     */
    public function removeTextLineItem()
    {
        return ShoppingListRemoveTextLineItemAction::of();
    }

    /**
     * @return ShoppingListRemoveLineItemAction
     */
    public function removeLineItem()
    {
        return ShoppingListRemoveLineItemAction::of();
    }

    /**
     * @return ShoppingListChangeTextLineItemQuantityAction
     */
    public function changeTextLineItemQuantity()
    {
        return ShoppingListChangeTextLineItemQuantityAction::of();
    }

    /**
     * @return ShoppingListSetCustomTypeAction
     */
    public function setCustomType()
    {
        return ShoppingListSetCustomTypeAction::of();
    }

    /**
     * @return ShoppingListChangeTextLineItemsOrderAction
     */
    public function changeTextLineItemsOrder()
    {
        return ShoppingListChangeTextLineItemsOrderAction::of();
    }

    /**
     * @return ShoppingListSetKeyAction
     */
    public function setKey()
    {
        return ShoppingListSetKeyAction::of();
    }

    /**
     * @return ShoppingListSetLineItemCustomTypeAction
     */
    public function setLineItemCustomType()
    {
        return ShoppingListSetLineItemCustomTypeAction::of();
    }

    /**
     * @return ShoppingListChangeTextLineItemNameAction
     */
    public function changeTextLineItemName()
    {
        return ShoppingListChangeTextLineItemNameAction::of();
    }

    /**
     * @return ShoppingListChangeLineItemQuantityAction
     */
    public function changeLineItemQuantity()
    {
        return ShoppingListChangeLineItemQuantityAction::of();
    }

    /**
     * @return ShoppingListAddLineItemAction
     */
    public function addLineItem()
    {
        return ShoppingListAddLineItemAction::of();
    }

    /**
     * @return ShoppingListAddTextLineItemAction
     */
    public function addTextLineItem()
    {
        return ShoppingListAddTextLineItemAction::of();
    }

    /**
     * @return ShoppingListChangeLineItemsOrderAction
     */
    public function changeLineItemsOrder()
    {
        return ShoppingListChangeLineItemsOrderAction::of();
    }
}
