<?php
/**
 *
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Request\Carts\Command\CartSetCustomLineItemShippingDetailsAction;
use Commercetools\Core\Model\Cart\ItemShippingDetailsDraft;

/**
 * @package Commercetools\Core\Request\Orders\Command
 * @link https://docs.commercetools.com/http-api-projects-orders.html#set-customlineitemshippingdetails
 * @method string getAction()
 * @method OrderSetCustomLineItemShippingDetailsAction setAction(string $action = null)
 * @method string getCustomLineItemId()
 * @method OrderSetCustomLineItemShippingDetailsAction setCustomLineItemId(string $customLineItemId = null)
 * @method ItemShippingDetailsDraft getShippingDetails()
 * phpcs:disable
 * @method OrderSetCustomLineItemShippingDetailsAction setShippingDetails(ItemShippingDetailsDraft $shippingDetails = null)
 * phpcs:enable
 */
class OrderSetCustomLineItemShippingDetailsAction extends CartSetCustomLineItemShippingDetailsAction
{

}
