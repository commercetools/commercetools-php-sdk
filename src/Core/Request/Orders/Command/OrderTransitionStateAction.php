<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Request\States\Command\TransitionStateAction;
use Commercetools\Core\Model\State\StateReference;

/**
 * @package Commercetools\Core\Request\Orders\Command
 * @link https://docs.commercetools.com/http-api-projects-orders.html#transition-state
 * @method string getAction()
 * @method OrderTransitionStateAction setAction(string $action = null)
 * @method StateReference getState()
 * @method OrderTransitionStateAction setState(StateReference $state = null)
 * @method bool getForce()
 * @method OrderTransitionStateAction setForce(bool $force = null)
 */
class OrderTransitionStateAction extends TransitionStateAction
{
}
