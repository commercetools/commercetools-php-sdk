<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\DiscountCode;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\DiscountCode
 * @link https://dev.commercetools.com/http-api-projects-discountCodes.html#discountcode
 * @method DiscountCode current()
 * @method DiscountCodeCollection add(DiscountCode $element)
 * @method DiscountCode getAt($offset)
 */
class DiscountCodeCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\DiscountCode\DiscountCode';
}
