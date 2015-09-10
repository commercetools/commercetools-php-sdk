<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;


/**
 * @package Commercetools\Core\Model\Common
 *
 * @method Enum current()
 * @method EnumCollection add(Enum $element)
 * @method Enum getAt($offset)
 */
class EnumCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Common\Enum';
}
