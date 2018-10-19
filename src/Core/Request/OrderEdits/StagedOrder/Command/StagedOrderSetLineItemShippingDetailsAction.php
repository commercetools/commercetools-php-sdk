<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderSetLineItemShippingDetailsAction;
use Commercetools\Core\Model\Cart\ItemShippingDetailsDraft;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetLineItemShippingDetailsAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method StagedOrderSetLineItemShippingDetailsAction setLineItemId(string $lineItemId = null)
 * @method ItemShippingDetailsDraft getShippingDetails()
 * phpcs:disable
 * @method StagedOrderSetLineItemShippingDetailsAction setShippingDetails(ItemShippingDetailsDraft $shippingDetails = null)
 * phpcs:enable
 */
// phpcs:ignore
class StagedOrderSetLineItemShippingDetailsAction extends OrderSetLineItemShippingDetailsAction implements StagedOrderUpdateAction
{

}
