<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\DiscountCode;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\DiscountCode
 * @link https://docs.commercetools.com/http-api-types.html#reference-types
 * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#discountcode
 * @method DiscountCodeReference current()
 * @method DiscountCodeReferenceCollection add(DiscountCodeReference $element)
 * @method DiscountCodeReference getAt($offset)
 * @method DiscountCodeReference getById($offset)
 */
class DiscountCodeReferenceCollection extends Collection
{
    protected $type = DiscountCodeReference::class;
}
