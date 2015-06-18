<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Inventory;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractQueryRequest;

/**
 * Class InventoryQueryRequest
 * @package Sphere\Core\Request\Inventory
 * @link http://dev.sphere.io/http-api-projects-inventory.html#inventories-by-query
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
}
