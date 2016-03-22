<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://dev.commercetools.com/http-api-projects-carts.html#line-item
 * @method LineItem current()
 * @method LineItemCollection add(LineItem $element)
 * @method LineItem getAt($offset)
 */
class LineItemCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Cart\LineItem';
}
