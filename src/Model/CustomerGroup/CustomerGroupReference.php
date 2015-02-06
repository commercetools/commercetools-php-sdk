<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:46
 */

namespace Sphere\Core\Model\CustomerGroup;

use Sphere\Core\Model\Type\Reference;

/**
 * Class CustomerGroupReference
 * @package Sphere\Core\Model\Type
 * @method static CustomerGroupReference of(string $id)
 */
class CustomerGroupReference extends Reference
{
    const TYPE_CUSTOMER_GROUP = 'customer-group';

    /**
     * @param string $id
     */
    public function __construct($id)
    {
        parent::__construct(static::TYPE_CUSTOMER_GROUP, $id);
    }
}
