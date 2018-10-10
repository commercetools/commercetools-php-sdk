<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Orders\Command\OrderTransitionStateAction;
use Commercetools\Core\Model\State\StateReference;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderTransitionStateAction setAction(string $action = null)
 * @method StateReference getState()
 * @method StagedOrderTransitionStateAction setState(StateReference $state = null)
 * @method bool getForce()
 * @method StagedOrderTransitionStateAction setForce(bool $force = null)
 */
class StagedOrderTransitionStateAction extends OrderTransitionStateAction implements StagedOrderUpdateAction
{
}
