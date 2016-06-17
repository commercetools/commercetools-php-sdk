<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Cart
 * @link http://dev.commercetools.com/http-api-projects-me-carts.html#mylineitemdraft
 * @method MyLineItemDraft current()
 * @method MyLineItemDraftCollection add(MyLineItemDraft $element)
 * @method MyLineItemDraft getAt($offset)
 */
class MyLineItemDraftCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Cart\MyLineItemDraft';
}
