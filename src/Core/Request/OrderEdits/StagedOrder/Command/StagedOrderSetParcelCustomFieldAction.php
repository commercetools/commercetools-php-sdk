<?php

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderSetParcelCustomFieldAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetParcelCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method StagedOrderSetParcelCustomFieldAction setName(string $name = null)
 * @method string getParcelId()
 * @method StagedOrderSetParcelCustomFieldAction setParcelId(string $parcelId = null)
 * @method mixed getValue()
 * @method StagedOrderSetParcelCustomFieldAction setValue($value = null)
 */
class StagedOrderSetParcelCustomFieldAction extends OrderSetParcelCustomFieldAction implements StagedOrderUpdateAction
{
}
