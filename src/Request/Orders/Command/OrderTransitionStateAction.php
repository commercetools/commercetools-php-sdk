<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Request\States\Command\TransitionStateAction;
use Commercetools\Core\Model\State\StateReference;

/**
 * @package Commercetools\Core\Request\Orders\Command
 *
 * @method string getAction()
 * @method OrderTransitionStateAction setAction(string $action = null)
 * @method StateReference getState()
 * @method OrderTransitionStateAction setState(StateReference $state = null)
 */
class OrderTransitionStateAction extends TransitionStateAction
{

}
