<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Inventory;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Inventory\InventoryDraft;
use Sphere\Core\Request\AbstractCreateRequest;

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
}
