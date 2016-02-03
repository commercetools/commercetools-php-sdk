<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Customer\CustomerReference;
use Commercetools\Core\Model\State\StateReference;
use Commercetools\Core\Request\States\Command\TransitionStateAction;

/**
 * @package Commercetools\Core\Request\Payments\Command
 *
 * @method string getAction()
 * @method PaymentTransitionStateAction setAction(string $action = null)
 * @method StateReference getState()
 * @method PaymentTransitionStateAction setState(StateReference $state = null)
 * @method bool getForce()
 * @method PaymentTransitionStateAction setForce(bool $force = null)
 */
class PaymentTransitionStateAction extends TransitionStateAction
{
}
