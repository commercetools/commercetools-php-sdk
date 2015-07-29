<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


/**
 * @package Sphere\Core\Model\Common
 * @method Money current()
 * @method Money getAt($offset)
 */
class MoneyCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Common\Money';
}
