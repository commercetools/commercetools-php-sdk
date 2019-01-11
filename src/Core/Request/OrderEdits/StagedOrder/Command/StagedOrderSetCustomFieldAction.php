<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderSetCustomFieldAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method StagedOrderSetCustomFieldAction setName(string $name = null)
 * @method mixed getValue()
 * @method StagedOrderSetCustomFieldAction setValue($value = null)
 */
class StagedOrderSetCustomFieldAction extends OrderSetCustomFieldAction implements StagedOrderUpdateAction
{
}
