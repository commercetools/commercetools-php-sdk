<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\Inventory\Command\InventorySetExpectedDeliveryAction;
use Commercetools\Core\Request\Inventory\Command\InventoryAddQuantityAction;
use Commercetools\Core\Request\Inventory\Command\InventoryChangeQuantityAction;
use Commercetools\Core\Request\Inventory\Command\InventorySetSupplyChannelAction;
use Commercetools\Core\Request\Inventory\Command\InventorySetRestockableInDaysAction;
use Commercetools\Core\Request\Inventory\Command\InventoryRemoveQuantityAction;

class InventoryActionBuilder
{
    /**
     * @return InventorySetExpectedDeliveryAction
     */
    public function setExpectedDelivery()
    {
        return InventorySetExpectedDeliveryAction::of();
    }

    /**
     * @return InventoryAddQuantityAction
     */
    public function addQuantity()
    {
        return InventoryAddQuantityAction::of();
    }

    /**
     * @return InventoryChangeQuantityAction
     */
    public function changeQuantity()
    {
        return InventoryChangeQuantityAction::of();
    }

    /**
     * @return InventorySetSupplyChannelAction
     */
    public function setSupplyChannel()
    {
        return InventorySetSupplyChannelAction::of();
    }

    /**
     * @return InventorySetRestockableInDaysAction
     */
    public function setRestockableInDays()
    {
        return InventorySetRestockableInDaysAction::of();
    }

    /**
     * @return InventoryRemoveQuantityAction
     */
    public function removeQuantity()
    {
        return InventoryRemoveQuantityAction::of();
    }
}
