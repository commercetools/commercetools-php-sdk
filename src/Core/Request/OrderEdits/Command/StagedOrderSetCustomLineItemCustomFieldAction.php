<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Orders\Command\OrderSetCustomLineItemCustomFieldAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderSetCustomLineItemCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method StagedOrderSetCustomLineItemCustomFieldAction setName(string $name = null)
 * @method string getCustomLineItemId()
 * @method StagedOrderSetCustomLineItemCustomFieldAction setCustomLineItemId(string $customLineItemId = null)
 * @method mixed getValue()
 * @method StagedOrderSetCustomLineItemCustomFieldAction setValue($value = null)
 */
class StagedOrderSetCustomLineItemCustomFieldAction extends OrderSetCustomLineItemCustomFieldAction implements StagedOrderUpdateAction
{
}
