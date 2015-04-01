<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ShippingMethod;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;
use Sphere\Core\Model\Common\ReferenceFromArrayTrait;

class ShippingMethodReference extends Reference
{
    use ReferenceFromArrayTrait;

    const TYPE_SHIPPING_METHOD = 'shipping-method';

    /**
     * @param string $id
     * @param Context|callable $context
     */
    public function __construct($id, $context = null)
    {
        parent::__construct(static::TYPE_SHIPPING_METHOD, $id, $context);
    }
}
