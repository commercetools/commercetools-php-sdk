<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Cart;

use Sphere\Core\Model\Common\Collection;

/**
 * Class LineItemCollection
 * @package Sphere\Core\Model\Cart
 * @method LineItem current()
 * @method LineItem getAt($offset)
 */
class LineItemCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Cart\LineItem';
}
