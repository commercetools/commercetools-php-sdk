<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://dev.commercetools.com/http-api-types.html#money
 * @method Money current()
 * @method MoneyCollection add(Money $element)
 * @method Money getAt($offset)
 */
class MoneyCollection extends Collection
{
    protected $type = Money::class;
}
