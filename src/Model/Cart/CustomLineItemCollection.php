<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Cart;

use Sphere\Core\Model\Common\Collection;

/**
 * @package Sphere\Core\Model\Cart
 * @method CustomLineItem current()
 * @method CustomLineItem getAt($offset)
 */
class CustomLineItemCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Cart\CustomLineItem';
}
