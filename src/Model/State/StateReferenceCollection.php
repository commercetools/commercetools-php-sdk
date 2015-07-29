<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\State;

use Sphere\Core\Model\Common\Collection;

/**
 * @package Sphere\Core\Model\State
 * @method StateReference current()
 * @method StateReference getAt($offset)
 */
class StateReferenceCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\State\StateReference';
}
