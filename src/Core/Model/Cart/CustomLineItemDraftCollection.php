<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://docs.commercetools.com/http-api-projects-carts.html#customlineitemdraft
 * @method CustomLineItemDraft current()
 * @method CustomLineItemDraftCollection add(CustomLineItemDraft $element)
 * @method CustomLineItemDraft getAt($offset)
 */
class CustomLineItemDraftCollection extends Collection
{
    protected $type = CustomLineItemDraft::class;
}
