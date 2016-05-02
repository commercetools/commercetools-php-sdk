<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\DiscountCode;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\DiscountCode
 * @link https://dev.commercetools.com/http-api-types.html#reference-types
 * @link https://dev.commercetools.com/http-api-projects-discountCodes.html#discount-code
 * @method string getTypeId()
 * @method DiscountCodeReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method DiscountCodeReference setId(string $id = null)
 * @method DiscountCode getObj()
 * @method DiscountCodeReference setObj(DiscountCode $obj = null)
 * @method string getKey()
 * @method DiscountCodeReference setKey(string $key = null)
 */
class DiscountCodeReference extends Reference
{
    const TYPE_DISCOUNT_CODE = 'discount-code';
    const TYPE_CLASS = '\Commercetools\Core\Model\DiscountCode\DiscountCode';

    /**
     * @param $id
     * @param Context|callable $context
     * @return DiscountCodeReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_DISCOUNT_CODE, $id, $context);
    }
}
