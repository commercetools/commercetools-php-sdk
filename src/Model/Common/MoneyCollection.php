<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @method Money current()
 * @method MoneyCollection add(Money $element)
 * @method Money getAt($offset)
 */
class MoneyCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Common\Money';
}
