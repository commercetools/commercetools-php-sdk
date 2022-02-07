<?php

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderSetReturnInfoAction;
use Commercetools\Core\Model\Order\ReturnInfoCollection;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetReturnInfoAction setAction(string $action = null)
 * @method string getEmail()
 * @method StagedOrderSetReturnInfoAction setEmail(string $email = null)
 * @method ReturnInfoCollection getItems()
 * @method StagedOrderSetReturnInfoAction setItems(ReturnInfoCollection $items = null)
 */
class StagedOrderSetReturnInfoAction extends OrderSetReturnInfoAction implements StagedOrderUpdateAction
{
}
