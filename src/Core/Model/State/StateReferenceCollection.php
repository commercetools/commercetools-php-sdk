<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\State;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\State
 * @link https://docs.commercetools.com/http-api-types.html#reference-types
 * @link https://docs.commercetools.com/http-api-projects-states.html#state
 * @method StateReference current()
 * @method StateReferenceCollection add(StateReference $element)
 * @method StateReference getAt($offset)
 * @method StateReference getById($offset)
 */
class StateReferenceCollection extends Collection
{
    protected $type = StateReference::class;
}
