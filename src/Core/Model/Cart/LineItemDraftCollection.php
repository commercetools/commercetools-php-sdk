<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://docs.commercetools.com/http-api-projects-carts.html#lineitemdraft
 * @method LineItemDraft current()
 * @method LineItemDraftCollection add(LineItemDraft $element)
 * @method LineItemDraft getAt($offset)
 */
class LineItemDraftCollection extends Collection
{
    protected $type = LineItemDraft::class;
}
