<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://dev.commercetools.com/http-api-projects-carts.html#custom-line-item-draft
 * @method CustomLineItemDraft current()
 * @method CustomLineItemDraftCollection add(CustomLineItemDraft $element)
 * @method CustomLineItemDraft getAt($offset)
 */
class CustomLineItemDraftCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Cart\CustomLineItemDraft';
}
