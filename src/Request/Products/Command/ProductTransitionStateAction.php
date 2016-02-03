<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\State\StateReference;
use Commercetools\Core\Request\States\Command\TransitionStateAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 *
 * @method string getAction()
 * @method ProductTransitionStateAction setAction(string $action = null)
 * @method StateReference getState()
 * @method ProductTransitionStateAction setState(StateReference $state = null)
 * @method bool getForce()
 * @method ProductTransitionStateAction setForce(bool $force = null)
 */
class ProductTransitionStateAction extends TransitionStateAction
{
}
