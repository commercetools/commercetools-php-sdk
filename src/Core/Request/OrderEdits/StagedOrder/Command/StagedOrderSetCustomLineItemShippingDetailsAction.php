<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderSetCustomLineItemShippingDetailsAction;
use Commercetools\Core\Model\Cart\ItemShippingDetailsDraft;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetCustomLineItemShippingDetailsAction setAction(string $action = null)
 * @method string getCustomLineItemId()
 * @method StagedOrderSetCustomLineItemShippingDetailsAction setCustomLineItemId(string $customLineItemId = null)
 * @method ItemShippingDetailsDraft getShippingDetails()
 * phpcs:disable
 * @method StagedOrderSetCustomLineItemShippingDetailsAction setShippingDetails(ItemShippingDetailsDraft $shippingDetails = null)
 * phpcs:enable
 */
// phpcs:ignore
class StagedOrderSetCustomLineItemShippingDetailsAction extends OrderSetCustomLineItemShippingDetailsAction implements StagedOrderUpdateAction
{
}
