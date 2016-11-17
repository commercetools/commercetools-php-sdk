<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Inventory;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Inventory\InventoryDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\Inventory\InventoryEntry;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Inventory
 * @link https://dev.commercetools.com/http-api-projects-inventory.html#create-an-inventoryentry
 * @method InventoryEntry mapResponse(ApiResponseInterface $response)
 * @method InventoryEntry mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class InventoryCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Inventory\InventoryEntry';

    /**
     * @param InventoryDraft $inventory
     * @param Context $context
     */
    public function __construct(InventoryDraft $inventory, Context $context = null)
    {
        parent::__construct(InventoryEndpoint::endpoint(), $inventory, $context);
    }

    /**
     * @param InventoryDraft $inventory
     * @param Context $context
     * @return static
     */
    public static function ofDraft(InventoryDraft $inventory, Context $context = null)
    {
        return new static($inventory, $context);
    }
}
