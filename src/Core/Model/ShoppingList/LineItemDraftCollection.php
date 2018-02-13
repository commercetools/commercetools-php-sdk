<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShoppingList;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\ShoppingList
 *
 * @method LineItemDraftCollection add(LineItemDraft $element)
 * @method LineItemDraft current()
 * @method LineItemDraft getAt($offset)
 */
class LineItemDraftCollection extends Collection
{
    protected $type = LineItemDraft::class;
}
