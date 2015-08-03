<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Cart
 * @method LineItem current()
 * @method LineItem getAt($offset)
 */
class LineItemCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Cart\LineItem';
}
