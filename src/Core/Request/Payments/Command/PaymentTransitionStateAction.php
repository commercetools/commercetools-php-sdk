<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Customer\CustomerReference;
use Commercetools\Core\Model\State\StateReference;
use Commercetools\Core\Request\States\Command\TransitionStateAction;

/**
 * @package Commercetools\Core\Request\Payments\Command
 * @link https://docs.commercetools.com/http-api-projects-payments.html#transition-state
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
