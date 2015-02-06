<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\Reference;

/**
 * Class CategoryReference
 * @package Sphere\Core\Model\Type
 * @method static OrderReference of(string $id)
 */
class OrderReference extends Reference
{
    const TYPE_ORDER = 'order';

    /**
     * @param string $id
     */
    public function __construct($id)
    {
        parent::__construct(static::TYPE_ORDER, $id);
    }
}
