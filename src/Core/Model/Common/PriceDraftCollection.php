<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://docs.commercetools.com/http-api-projects-products.html#pricedraft
 * @method PriceDraftCollection add(PriceDraft $element)
 * @method PriceDraft current()
 * @method PriceDraft getAt($offset)
 */
class PriceDraftCollection extends Collection
{
    protected $type = PriceDraft::class;
}
