<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Cart
 * @method CustomLineItem current()
 * @method CustomLineItemCollection add(CustomLineItem $element)
 * @method CustomLineItem getAt($offset)
 */
class CustomLineItemCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Cart\CustomLineItem';
}
