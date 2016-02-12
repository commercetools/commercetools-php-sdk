<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://dev.commercetools.com/http-api-projects-products.html#product-price
 * @method Price current()
 * @method PriceCollection add(Price $element)
 * @method Price getAt($offset)
 */
class PriceCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Common\Price';
}
