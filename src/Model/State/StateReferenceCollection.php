<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\State;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\State
 * @method StateReference current()
 * @method StateReferenceCollection add(StateReference $element)
 * @method StateReference getAt($offset)
 */
class StateReferenceCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\State\StateReference';
}
