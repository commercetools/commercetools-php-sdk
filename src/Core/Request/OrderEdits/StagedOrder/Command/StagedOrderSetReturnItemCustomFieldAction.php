<?php

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderSetReturnItemCustomFieldAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetReturnItemCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method StagedOrderSetReturnItemCustomFieldAction setName(string $name = null)
 * @method string getReturnItemId()
 * @method StagedOrderSetReturnItemCustomFieldAction setReturnItemId(string $returnItemId = null)
 * @method mixed getValue()
 * @method StagedOrderSetReturnItemCustomFieldAction setValue($value = null)
 */
// phpcs:ignore
class StagedOrderSetReturnItemCustomFieldAction extends OrderSetReturnItemCustomFieldAction implements StagedOrderUpdateAction
{
}
