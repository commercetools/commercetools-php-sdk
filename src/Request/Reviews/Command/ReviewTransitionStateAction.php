<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Reviews\Command;

use Commercetools\Core\Request\States\Command\TransitionStateAction;
use Commercetools\Core\Model\State\StateReference;

/**
 * @package Commercetools\Core\Request\Reviews\Command
 *
 * @method string getAction()
 * @method ReviewTransitionStateAction setAction(string $action = null)
 * @method StateReference getState()
 * @method ReviewTransitionStateAction setState(StateReference $state = null)
 */
class ReviewTransitionStateAction extends TransitionStateAction
{
}
