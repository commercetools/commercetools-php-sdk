<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Carts\Command\CartRemoveCustomLineItemAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderRemoveCustomLineItemAction setAction(string $action = null)
 * @method string getCustomLineItemId()
 * @method StagedOrderRemoveCustomLineItemAction setCustomLineItemId(string $customLineItemId = null)
 */
class StagedOrderRemoveCustomLineItemAction extends CartRemoveCustomLineItemAction implements StagedOrderUpdateAction
{

}
