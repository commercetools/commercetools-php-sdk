<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Inventory;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Inventory\InventoryDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\Inventory\InventoryEntry;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Inventory
 *
 * @method InventoryEntry mapResponse(ApiResponseInterface $response)
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
