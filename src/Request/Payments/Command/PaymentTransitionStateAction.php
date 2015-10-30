<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
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
 */
class PaymentTransitionStateAction extends TransitionStateAction
{
}
