<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Inventory;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Inventory\InventoryDraft;
use Sphere\Core\Request\AbstractCreateRequest;
use Sphere\Core\Model\Inventory\InventoryEntry;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\Inventory
 * 
 * @method InventoryEntry mapResponse(ApiResponseInterface $response)
 */
class InventoryCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Sphere\Core\Model\Inventory\InventoryEntry';

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
