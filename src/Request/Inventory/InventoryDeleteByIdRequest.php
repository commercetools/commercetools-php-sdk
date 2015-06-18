<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Inventory;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractDeleteByIdRequest;

/**
 * Class InventoryDeleteByIdRequest
 * @package Sphere\Core\Request\Inventory
 * @link http://dev.sphere.io/http-api-projects-inventory.html#delete-inventory
 */
class InventoryDeleteByIdRequest extends AbstractDeleteByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\Inventory\InventoryEntry';

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(InventoryEndpoint::endpoint(), $id, $version, $context);
    }
}
