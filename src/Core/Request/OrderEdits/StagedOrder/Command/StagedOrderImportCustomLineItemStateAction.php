<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderImportCustomLineItemStateAction;
use Commercetools\Core\Model\Order\ItemStateCollection;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderImportCustomLineItemStateAction setAction(string $action = null)
 * @method string getCustomLineItemId()
 * @method StagedOrderImportCustomLineItemStateAction setCustomLineItemId(string $customLineItemId = null)
 * @method ItemStateCollection getState()
 * @method StagedOrderImportCustomLineItemStateAction setState(ItemStateCollection $state = null)
 */
class StagedOrderImportCustomLineItemStateAction extends OrderImportCustomLineItemStateAction implements StagedOrderUpdateAction
{

}
