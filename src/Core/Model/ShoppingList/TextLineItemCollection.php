<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShoppingList;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\ShoppingList
 *
 * @method TextLineItemCollection add(TextLineItem $element)
 * @method TextLineItem current()
 * @method TextLineItem getAt($offset)
 * @method TextLineItem getById($offset)
 */
class TextLineItemCollection extends Collection
{
    protected $type = TextLineItem::class;
}
