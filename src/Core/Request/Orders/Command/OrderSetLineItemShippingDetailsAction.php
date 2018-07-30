<?php
/**
 *
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Request\Carts\Command\CartSetLineItemShippingDetailsAction;
use Commercetools\Core\Model\Cart\ItemShippingDetailsDraft;

/**
 * @package Commercetools\Core\Request\Orders\Command
 *
 * @method string getAction()
 * @method OrderSetLineItemShippingDetailsAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method OrderSetLineItemShippingDetailsAction setLineItemId(string $lineItemId = null)
 * @method ItemShippingDetailsDraft getShippingDetails()
 * @method OrderSetLineItemShippingDetailsAction setShippingDetails(ItemShippingDetailsDraft $shippingDetails = null)
 */
class OrderSetLineItemShippingDetailsAction extends CartSetLineItemShippingDetailsAction
{

}
