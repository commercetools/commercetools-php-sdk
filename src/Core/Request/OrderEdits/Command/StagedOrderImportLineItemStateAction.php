<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Orders\Command\OrderImportLineItemStateAction;
use Commercetools\Core\Model\Order\ItemStateCollection;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderImportLineItemStateAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method StagedOrderImportLineItemStateAction setLineItemId(string $lineItemId = null)
 * @method ItemStateCollection getState()
 * @method StagedOrderImportLineItemStateAction setState(ItemStateCollection $state = null)
 */
class StagedOrderImportLineItemStateAction extends OrderImportLineItemStateAction implements StagedOrderUpdateAction
{
}
