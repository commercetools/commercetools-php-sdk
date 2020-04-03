<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Carts\Command\CartChangeLineItemQuantityAction;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Cart\ExternalLineItemTotalPrice;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderChangeLineItemQuantityAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method StagedOrderChangeLineItemQuantityAction setLineItemId(string $lineItemId = null)
 * @method int getQuantity()
 * @method StagedOrderChangeLineItemQuantityAction setQuantity(int $quantity = null)
 * @method Money getExternalPrice()
 * @method StagedOrderChangeLineItemQuantityAction setExternalPrice(Money $externalPrice = null)
 * @method ExternalLineItemTotalPrice getExternalTotalPrice()
 * phpcs:disable
 * @method StagedOrderChangeLineItemQuantityAction setExternalTotalPrice(ExternalLineItemTotalPrice $externalTotalPrice = null)
 * phpcs:enable
 */
// phpcs:ignore
class StagedOrderChangeLineItemQuantityAction extends CartChangeLineItemQuantityAction implements StagedOrderUpdateAction
{
}
