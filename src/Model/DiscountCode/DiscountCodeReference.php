<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\DiscountCode;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;
use Sphere\Core\Model\Common\ReferenceFromArrayTrait;

class DiscountCodeReference extends Reference
{
    use ReferenceFromArrayTrait;

    const TYPE_DISCOUNT_CODE = 'discount-code';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(static::TYPE_DISCOUNT_CODE, $id, $context);
    }
}
