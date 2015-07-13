<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


/**
 * Class EnumCollection
 * @package Sphere\Core\Model\Common
 * 
 * @method Enum current()
 * @method Enum getAt($offset)
 */
class EnumCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Common\Enum';
}
