<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\DiscountCode;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\DiscountCode
 * @link https://dev.commercetools.com/http-api-types.html#reference-types
 * @link https://dev.commercetools.com/http-api-projects-discountCodes.html#discount-code
 * @method DiscountCodeReference current()
 * @method DiscountCodeReferenceCollection add(DiscountCodeReference $element)
 * @method DiscountCodeReference getAt($offset)
 */
class DiscountCodeReferenceCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\DiscountCode\DiscountCodeReference';
}
