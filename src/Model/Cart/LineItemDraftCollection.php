<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://dev.commercetools.com/http-api-projects-carts.html#line-item-draft
 * @method LineItemDraft current()
 * @method LineItemDraftCollection add(LineItemDraft $element)
 * @method LineItemDraft getAt($offset)
 */
class LineItemDraftCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Cart\LineItemDraft';
}
