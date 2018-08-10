<?php

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\Inventory\InventoryByIdGetRequest;
use Commercetools\Core\Request\Inventory\InventoryCreateRequest;
use Commercetools\Core\Model\Inventory\InventoryDraft;
use Commercetools\Core\Request\Inventory\InventoryDeleteRequest;
use Commercetools\Core\Model\Inventory\InventoryEntry;
use Commercetools\Core\Request\Inventory\InventoryQueryRequest;
use Commercetools\Core\Request\Inventory\InventoryUpdateRequest;

class InventoryRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-inventory.html#get-inventoryentry-by-id
     * @param string $id
     * @return InventoryByIdGetRequest
     */
    public function getById($id)
    {
        $request = InventoryByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-inventory.html#create-an-inventoryentry
     * @param InventoryDraft $inventory
     * @return InventoryCreateRequest
     */
    public function create(InventoryDraft $inventory)
    {
        $request = InventoryCreateRequest::ofDraft($inventory);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-inventory.html#delete-an-inventoryentry
     * @param InventoryEntry $inventory
     * @return InventoryDeleteRequest
     */
    public function delete(InventoryEntry $inventory)
    {
        $request = InventoryDeleteRequest::ofIdAndVersion($inventory->getId(), $inventory->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-inventory.html#query-inventory
     * @param 
     * @return InventoryQueryRequest
     */
    public function query()
    {
        $request = InventoryQueryRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-inventory.html#update-an-inventoryentry
     * @param InventoryEntry $inventory
     * @return InventoryUpdateRequest
     */
    public function update(InventoryEntry $inventory)
    {
        $request = InventoryUpdateRequest::ofIdAndVersion($inventory->getId(), $inventory->getVersion());
        return $request;
    }

    /**
     * @return InventoryRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
