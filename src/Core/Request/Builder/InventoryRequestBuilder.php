<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Builder;

use Commercetools\Core\Model\Inventory\InventoryDraft;
use Commercetools\Core\Model\Inventory\InventoryEntry;
use Commercetools\Core\Request\Inventory\InventoryByIdGetRequest;
use Commercetools\Core\Request\Inventory\InventoryCreateRequest;
use Commercetools\Core\Request\Inventory\InventoryDeleteRequest;
use Commercetools\Core\Request\Inventory\InventoryQueryRequest;
use Commercetools\Core\Request\Inventory\InventoryUpdateRequest;

class InventoryRequestBuilder
{
    /**
     * @return InventoryQueryRequest
     */
    public function query()
    {
        return InventoryQueryRequest::of();
    }

    /**
     * @param InventoryEntry $inventory
     * @return InventoryUpdateRequest
     */
    public function update(InventoryEntry $inventory)
    {
        return InventoryUpdateRequest::ofIdAndVersion($inventory->getId(), $inventory->getVersion());
    }

    /**
     * @param InventoryDraft $inventoryDraft
     * @return InventoryCreateRequest
     */
    public function create(InventoryDraft $inventoryDraft)
    {
        return InventoryCreateRequest::ofDraft($inventoryDraft);
    }

    /**
     * @param InventoryEntry $inventory
     * @return InventoryDeleteRequest
     */
    public function delete(InventoryEntry $inventory)
    {
        return InventoryDeleteRequest::ofIdAndVersion($inventory->getId(), $inventory->getVersion());
    }

    /**
     * @param $id
     * @return InventoryByIdGetRequest
     */
    public function getById($id)
    {
        return InventoryByIdGetRequest::ofId($id);
    }
}
