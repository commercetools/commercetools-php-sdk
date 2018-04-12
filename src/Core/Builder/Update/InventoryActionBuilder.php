<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\Inventory\Command\InventoryAddQuantityAction;
use Commercetools\Core\Request\Inventory\Command\InventoryChangeQuantityAction;
use Commercetools\Core\Request\Inventory\Command\InventoryRemoveQuantityAction;
use Commercetools\Core\Request\Inventory\Command\InventorySetExpectedDeliveryAction;
use Commercetools\Core\Request\Inventory\Command\InventorySetRestockableInDaysAction;
use Commercetools\Core\Request\Inventory\Command\InventorySetSupplyChannelAction;

class InventoryActionBuilder
{
    /**
     * @link https://docs.commercetools.com/http-api-projects-inventory.html#add-quantity
     * @param array $data
     * @return InventoryAddQuantityAction
     */
    public function addQuantity(array $data = [])
    {
        return InventoryAddQuantityAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-inventory.html#change-quantity
     * @param array $data
     * @return InventoryChangeQuantityAction
     */
    public function changeQuantity(array $data = [])
    {
        return InventoryChangeQuantityAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-inventory.html#remove-quantity
     * @param array $data
     * @return InventoryRemoveQuantityAction
     */
    public function removeQuantity(array $data = [])
    {
        return InventoryRemoveQuantityAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-inventory.html#set-expecteddelivery
     * @param array $data
     * @return InventorySetExpectedDeliveryAction
     */
    public function setExpectedDelivery(array $data = [])
    {
        return InventorySetExpectedDeliveryAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-inventory.html#set-restockableindays
     * @param array $data
     * @return InventorySetRestockableInDaysAction
     */
    public function setRestockableInDays(array $data = [])
    {
        return InventorySetRestockableInDaysAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-inventory.html#set-supplychannel
     * @param array $data
     * @return InventorySetSupplyChannelAction
     */
    public function setSupplyChannel(array $data = [])
    {
        return InventorySetSupplyChannelAction::fromArray($data);
    }

    /**
     * @return InventoryActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
