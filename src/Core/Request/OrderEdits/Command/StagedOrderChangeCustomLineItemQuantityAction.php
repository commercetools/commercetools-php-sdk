<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Carts\Command\CartChangeCustomLineItemQuantityAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderChangeCustomLineItemQuantityAction setAction(string $action = null)
 * @method string getCustomLineItemId()
 * @method StagedOrderChangeCustomLineItemQuantityAction setCustomLineItemId(string $customLineItemId = null)
 * @method int getQuantity()
 * @method StagedOrderChangeCustomLineItemQuantityAction setQuantity(int $quantity = null)
 */
class StagedOrderChangeCustomLineItemQuantityAction extends CartChangeCustomLineItemQuantityAction implements StagedOrderUpdateAction
{

}
