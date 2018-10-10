<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Carts\Command\CartSetLineItemPriceAction;
use Commercetools\Core\Model\Common\Money;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderSetLineItemPriceAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method StagedOrderSetLineItemPriceAction setLineItemId(string $lineItemId = null)
 * @method Money getExternalPrice()
 * @method StagedOrderSetLineItemPriceAction setExternalPrice(Money $externalPrice = null)
 */
class StagedOrderSetLineItemPriceAction extends CartSetLineItemPriceAction implements StagedOrderUpdateAction
{

}
