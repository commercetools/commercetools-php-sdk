<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Orders\Command\OrderTransitionCustomLineItemStateAction;
use Commercetools\Core\Model\State\StateReference;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderTransitionCustomLineItemStateAction setAction(string $action = null)
 * @method string getCustomLineItemId()
 * @method StagedOrderTransitionCustomLineItemStateAction setCustomLineItemId(string $customLineItemId = null)
 * @method int getQuantity()
 * @method StagedOrderTransitionCustomLineItemStateAction setQuantity(int $quantity = null)
 * @method StateReference getFromState()
 * @method StagedOrderTransitionCustomLineItemStateAction setFromState(StateReference $fromState = null)
 * @method StateReference getToState()
 * @method StagedOrderTransitionCustomLineItemStateAction setToState(StateReference $toState = null)
 * @method DateTimeDecorator getActualTransitionDate()
 * phpcs:disable
 * @method StagedOrderTransitionCustomLineItemStateAction setActualTransitionDate(DateTime $actualTransitionDate = null)
 * phpcs:enable
 */
class StagedOrderTransitionCustomLineItemStateAction extends OrderTransitionCustomLineItemStateAction implements StagedOrderUpdateAction
{
}
