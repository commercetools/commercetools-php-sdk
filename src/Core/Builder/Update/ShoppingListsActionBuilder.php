<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
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
use Commercetools\Core\Request\ShoppingLists\Command\ShoppingListSetAnonymousIdAction;
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
    private $actions = [];

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#add-lineitem
     * @param ShoppingListAddLineItemAction|callable $action
     * @return $this
     */
    public function addLineItem($action = null)
    {
        $this->addAction($this->resolveAction(ShoppingListAddLineItemAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#add-textlineitem
     * @param ShoppingListAddTextLineItemAction|callable $action
     * @return $this
     */
    public function addTextLineItem($action = null)
    {
        $this->addAction($this->resolveAction(ShoppingListAddTextLineItemAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#change-lineitem-quantity
     * @param ShoppingListChangeLineItemQuantityAction|callable $action
     * @return $this
     */
    public function changeLineItemQuantity($action = null)
    {
        $this->addAction($this->resolveAction(ShoppingListChangeLineItemQuantityAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#change-lineitems-order
     * @param ShoppingListChangeLineItemsOrderAction|callable $action
     * @return $this
     */
    public function changeLineItemsOrder($action = null)
    {
        $this->addAction($this->resolveAction(ShoppingListChangeLineItemsOrderAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#change-name
     * @param ShoppingListChangeNameAction|callable $action
     * @return $this
     */
    public function changeName($action = null)
    {
        $this->addAction($this->resolveAction(ShoppingListChangeNameAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#change-textlineitem-name
     * @param ShoppingListChangeTextLineItemNameAction|callable $action
     * @return $this
     */
    public function changeTextLineItemName($action = null)
    {
        $this->addAction($this->resolveAction(ShoppingListChangeTextLineItemNameAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#change-textlineitem-quantity
     * @param ShoppingListChangeTextLineItemQuantityAction|callable $action
     * @return $this
     */
    public function changeTextLineItemQuantity($action = null)
    {
        $this->addAction($this->resolveAction(ShoppingListChangeTextLineItemQuantityAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#change-textlineitems-order
     * @param ShoppingListChangeTextLineItemsOrderAction|callable $action
     * @return $this
     */
    public function changeTextLineItemsOrder($action = null)
    {
        $this->addAction($this->resolveAction(ShoppingListChangeTextLineItemsOrderAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#remove-lineitem
     * @param ShoppingListRemoveLineItemAction|callable $action
     * @return $this
     */
    public function removeLineItem($action = null)
    {
        $this->addAction($this->resolveAction(ShoppingListRemoveLineItemAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#remove-textlineitem
     * @param ShoppingListRemoveTextLineItemAction|callable $action
     * @return $this
     */
    public function removeTextLineItem($action = null)
    {
        $this->addAction($this->resolveAction(ShoppingListRemoveTextLineItemAction::class, $action));
        return $this;
    }

    /**
     *
     * @param ShoppingListSetAnonymousIdAction|callable $action
     * @return $this
     */
    public function setAnonymousId($action = null)
    {
        $this->addAction($this->resolveAction(ShoppingListSetAnonymousIdAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-customField
     * @param ShoppingListSetCustomFieldAction|callable $action
     * @return $this
     */
    public function setCustomField($action = null)
    {
        $this->addAction($this->resolveAction(ShoppingListSetCustomFieldAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-customType
     * @param ShoppingListSetCustomTypeAction|callable $action
     * @return $this
     */
    public function setCustomType($action = null)
    {
        $this->addAction($this->resolveAction(ShoppingListSetCustomTypeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-customer
     * @param ShoppingListSetCustomerAction|callable $action
     * @return $this
     */
    public function setCustomer($action = null)
    {
        $this->addAction($this->resolveAction(ShoppingListSetCustomerAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-deletedaysafterlastmodification
     * @param ShoppingListSetDeleteDaysAfterLastModificationAction|callable $action
     * @return $this
     */
    public function setDeleteDaysAfterLastModification($action = null)
    {
        $this->addAction($this->resolveAction(ShoppingListSetDeleteDaysAfterLastModificationAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#change-description
     * @param ShoppingListSetDescriptionAction|callable $action
     * @return $this
     */
    public function setDescription($action = null)
    {
        $this->addAction($this->resolveAction(ShoppingListSetDescriptionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-key
     * @param ShoppingListSetKeyAction|callable $action
     * @return $this
     */
    public function setKey($action = null)
    {
        $this->addAction($this->resolveAction(ShoppingListSetKeyAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-lineitem-customfield
     * @param ShoppingListSetLineItemCustomFieldAction|callable $action
     * @return $this
     */
    public function setLineItemCustomField($action = null)
    {
        $this->addAction($this->resolveAction(ShoppingListSetLineItemCustomFieldAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-lineitem-custom-type
     * @param ShoppingListSetLineItemCustomTypeAction|callable $action
     * @return $this
     */
    public function setLineItemCustomType($action = null)
    {
        $this->addAction($this->resolveAction(ShoppingListSetLineItemCustomTypeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-slug
     * @param ShoppingListSetSlugAction|callable $action
     * @return $this
     */
    public function setSlug($action = null)
    {
        $this->addAction($this->resolveAction(ShoppingListSetSlugAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-textlineitem-customfield
     * @param ShoppingListSetTextLineItemCustomFieldAction|callable $action
     * @return $this
     */
    public function setTextLineItemCustomField($action = null)
    {
        $this->addAction($this->resolveAction(ShoppingListSetTextLineItemCustomFieldAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-textlineitem-custom-type
     * @param ShoppingListSetTextLineItemCustomTypeAction|callable $action
     * @return $this
     */
    public function setTextLineItemCustomType($action = null)
    {
        $this->addAction($this->resolveAction(ShoppingListSetTextLineItemCustomTypeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-textlineitem-description
     * @param ShoppingListSetTextLineItemDescriptionAction|callable $action
     * @return $this
     */
    public function setTextLineItemDescription($action = null)
    {
        $this->addAction($this->resolveAction(ShoppingListSetTextLineItemDescriptionAction::class, $action));
        return $this;
    }

    /**
     * @return ShoppingListsActionBuilder
     */
    public static function of()
    {
        return new self();
    }

    /**
     * @param $class
     * @param $action
     * @return AbstractAction
     * @throws InvalidArgumentException
     */
    private function resolveAction($class, $action = null)
    {
        if (is_null($action) || is_callable($action)) {
            $callback = $action;
            $emptyAction = $class::of();
            $action = $this->callback($emptyAction, $callback);
        }
        if ($action instanceof $class) {
            return $action;
        }
        throw new InvalidArgumentException(
            sprintf('Expected method to be called with or callable to return %s', $class)
        );
    }

    /**
     * @param $action
     * @param callable $callback
     * @return AbstractAction
     */
    private function callback($action, callable $callback = null)
    {
        if (!is_null($callback)) {
            $action = $callback($action);
        }
        return $action;
    }

    /**
     * @param AbstractAction $action
     * @return $this;
     */
    public function addAction(AbstractAction $action)
    {
        $this->actions[] = $action;
        return $this;
    }

    /**
     * @return array
     */
    public function getActions()
    {
        return $this->actions;
    }


    /**
     * @param array $actions
     * @return $this
     */
    public function setActions(array $actions)
    {
        $this->actions = $actions;
        return $this;
    }
}
