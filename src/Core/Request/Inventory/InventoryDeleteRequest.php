<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Inventory;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractDeleteRequest;
use Commercetools\Core\Model\Inventory\InventoryEntry;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Inventory
 * @link https://dev.commercetools.com/http-api-projects-inventory.html#delete-an-inventoryentry
 * @method InventoryEntry mapResponse(ApiResponseInterface $response)
 * @method InventoryEntry mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class InventoryDeleteRequest extends AbstractDeleteRequest
{
    protected $resultClass = InventoryEntry::class;

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(InventoryEndpoint::endpoint(), $id, $version, $context);
    }

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofIdAndVersion($id, $version, Context $context = null)
    {
        return new static($id, $version, $context);
    }
}
