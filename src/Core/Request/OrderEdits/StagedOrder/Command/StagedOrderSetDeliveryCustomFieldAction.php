<?php

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderSetDeliveryCustomFieldAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetDeliveryCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method StagedOrderSetDeliveryCustomFieldAction setName(string $name = null)
 * @method mixed getValue()
 * @method StagedOrderSetDeliveryCustomFieldAction setValue($value = null)
 */
// phpcs:ignore
class StagedOrderSetDeliveryCustomFieldAction extends OrderSetDeliveryCustomFieldAction implements StagedOrderUpdateAction
{
}
