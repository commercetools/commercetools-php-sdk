<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\DiscountCode;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\DiscountCode
 * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#discountcode
 * @method DiscountCode current()
 * @method DiscountCodeCollection add(DiscountCode $element)
 * @method DiscountCode getAt($offset)
 * @method DiscountCode getById($offset)
 */
class DiscountCodeCollection extends Collection
{
    protected $type = DiscountCode::class;
}
