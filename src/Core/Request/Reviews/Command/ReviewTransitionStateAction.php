<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Reviews\Command;

use Commercetools\Core\Request\States\Command\TransitionStateAction;
use Commercetools\Core\Model\State\StateReference;

/**
 * @package Commercetools\Core\Request\Reviews\Command
 * @link https://docs.commercetools.com/http-api-projects-reviews.html#transition-state
 * @method string getAction()
 * @method ReviewTransitionStateAction setAction(string $action = null)
 * @method StateReference getState()
 * @method ReviewTransitionStateAction setState(StateReference $state = null)
 * @method bool getForce()
 * @method ReviewTransitionStateAction setForce(bool $force = null)
 */
class ReviewTransitionStateAction extends TransitionStateAction
{
}
