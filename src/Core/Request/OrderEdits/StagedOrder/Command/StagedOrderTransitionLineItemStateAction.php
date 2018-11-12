<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderTransitionLineItemStateAction;
use Commercetools\Core\Model\State\StateReference;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderTransitionLineItemStateAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method StagedOrderTransitionLineItemStateAction setLineItemId(string $lineItemId = null)
 * @method int getQuantity()
 * @method StagedOrderTransitionLineItemStateAction setQuantity(int $quantity = null)
 * @method StateReference getFromState()
 * @method StagedOrderTransitionLineItemStateAction setFromState(StateReference $fromState = null)
 * @method StateReference getToState()
 * @method StagedOrderTransitionLineItemStateAction setToState(StateReference $toState = null)
 * @method DateTimeDecorator getActualTransitionDate()
 * @method StagedOrderTransitionLineItemStateAction setActualTransitionDate(DateTime $actualTransitionDate = null)
 */
// phpcs:ignore
class StagedOrderTransitionLineItemStateAction extends OrderTransitionLineItemStateAction implements StagedOrderUpdateAction
{
}
