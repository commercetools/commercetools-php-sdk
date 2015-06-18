<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Inventory;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractFetchByIdRequest;

/**
 * Class InventoryFetchByIdRequest
 * @package Sphere\Core\Request\Inventory
 * @link http://dev.sphere.io/http-api-projects-inventory.html#inventory-by-id
 */
class InventoryFetchByIdRequest extends AbstractFetchByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\Inventory\InventoryEntry';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(InventoryEndpoint::endpoint(), $id, $context);
    }
}
