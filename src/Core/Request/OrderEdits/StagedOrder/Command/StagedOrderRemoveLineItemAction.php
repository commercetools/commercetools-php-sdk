<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Carts\Command\CartRemoveLineItemAction;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Cart\ExternalLineItemTotalPrice;
use Commercetools\Core\Model\Cart\ItemShippingDetailsDraft;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderRemoveLineItemAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method StagedOrderRemoveLineItemAction setLineItemId(string $lineItemId = null)
 * @method int getQuantity()
 * @method StagedOrderRemoveLineItemAction setQuantity(int $quantity = null)
 * @method Money getExternalPrice()
 * @method StagedOrderRemoveLineItemAction setExternalPrice(Money $externalPrice = null)
 * @method ExternalLineItemTotalPrice getExternalTotalPrice()
 * @method StagedOrderRemoveLineItemAction setExternalTotalPrice(ExternalLineItemTotalPrice $externalTotalPrice = null)
 * @method ItemShippingDetailsDraft getShippingDetailsToRemove()
 * phpcs:disable
 * @method StagedOrderRemoveLineItemAction setShippingDetailsToRemove(ItemShippingDetailsDraft $shippingDetailsToRemove = null)
 * phpcs:enable
 */
class StagedOrderRemoveLineItemAction extends CartRemoveLineItemAction implements StagedOrderUpdateAction
{

}
