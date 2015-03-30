<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;
use Sphere\Core\Model\Common\ReferenceFromArrayTrait;

/**
 * Class OrderReference
 * @package Sphere\Core\Model\Order
 * @method static OrderReference of(string $id)
 * @method string getTypeId()
 * @method OrderReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method OrderReference setId(string $id = null)
 * @method array getObj()
 * @method OrderReference setObj(array $obj = null)
 */
class OrderReference extends Reference
{
    use ReferenceFromArrayTrait;

    const TYPE_ORDER = 'order';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(static::TYPE_ORDER, $id, $context);
    }
}
