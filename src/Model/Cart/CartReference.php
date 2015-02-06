<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\Cart;

use Sphere\Core\Model\Common\Reference;

/**
 * Class CategoryReference
 * @package Sphere\Core\Model\Type
 * @method static CartReference of(string $id)
 */
class CartReference extends Reference
{
    const TYPE_CART = 'cart';

    /**
     * @param string $id
     */
    public function __construct($id)
    {
        parent::__construct(static::TYPE_CART, $id);
    }
}
