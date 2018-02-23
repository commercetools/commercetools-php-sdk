<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShoppingList;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\ShoppingList
 *
 * @method LineItemCollection add(LineItem $element)
 * @method LineItem current()
 * @method LineItem getAt($offset)
 * @method LineItem getById($offset)
 */
class LineItemCollection extends Collection
{
    protected $type = LineItem::class;
}
