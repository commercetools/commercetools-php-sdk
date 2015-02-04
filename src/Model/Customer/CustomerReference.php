<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\Customer;

use Sphere\Core\Model\Type\Reference;

/**
 * Class CategoryReference
 * @package Sphere\Core\Model\Type
 * @method static CustomerReference of(string $id)
 */
class CustomerReference extends Reference
{
    const TYPE_CUSTOMER = 'customer';

    /**
     * @param string $id
     */
    public function __construct($id)
    {
        parent::__construct(static::TYPE_CUSTOMER, $id);
    }
}
