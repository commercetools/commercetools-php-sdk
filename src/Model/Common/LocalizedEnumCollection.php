<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


/**
 * Class LocalizedEnumCollection
 * @package Sphere\Core\Model\Common
 * 
 * @method LocalizedEnum current()
 * @method LocalizedEnum getAt($offset)
 */
class LocalizedEnumCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Common\LocalizedEnum';
}
