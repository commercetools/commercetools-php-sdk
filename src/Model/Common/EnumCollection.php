<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://dev.commercetools.com/http-api-projects-products.html#product-variant-attribute
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#plain-enum-value
 * @method Enum current()
 * @method EnumCollection add(Enum $element)
 * @method Enum getAt($offset)
 */
class EnumCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Common\Enum';
}
