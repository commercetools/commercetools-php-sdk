<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Inventory;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractQueryRequest;
use Sphere\Core\Model\Inventory\InventoryEntryCollection;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\Inventory
 * @apidoc http://dev.sphere.io/http-api-projects-inventory.html#inventories-by-query
 * @method InventoryEntryCollection mapResponse(ApiResponseInterface $response)
 */
class InventoryQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Sphere\Core\Model\Inventory\InventoryEntryCollection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(InventoryEndpoint::endpoint(), $context);
    }

    /**
     * @param Context $context
     * @return static
     */
    public static function of(Context $context = null)
    {
        return new static($context);
    }
}
