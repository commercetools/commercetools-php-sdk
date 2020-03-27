<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Carts\Command\CartSetLineItemTotalPriceAction;
use Commercetools\Core\Model\Cart\ExternalLineItemTotalPrice;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetLineItemTotalPriceAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method StagedOrderSetLineItemTotalPriceAction setLineItemId(string $lineItemId = null)
 * @method ExternalLineItemTotalPrice getExternalTotalPrice()
 * phpcs:disable
 * @method StagedOrderSetLineItemTotalPriceAction setExternalTotalPrice(ExternalLineItemTotalPrice $externalTotalPrice = null)
 * phpcs:enable
 */
class StagedOrderSetLineItemTotalPriceAction extends CartSetLineItemTotalPriceAction implements StagedOrderUpdateAction
{
}
