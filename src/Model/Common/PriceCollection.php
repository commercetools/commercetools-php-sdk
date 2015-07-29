<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


/**
 * @package Sphere\Core\Model\Common
 * @method Price current()
 * @method Price getAt($offset)
 */
class PriceCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Common\Price';
}
