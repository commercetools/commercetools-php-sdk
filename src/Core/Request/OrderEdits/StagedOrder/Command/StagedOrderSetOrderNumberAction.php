<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderSetOrderNumberAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetOrderNumberAction setAction(string $action = null)
 * @method string getOrderNumber()
 * @method StagedOrderSetOrderNumberAction setOrderNumber(string $orderNumber = null)
 */
class StagedOrderSetOrderNumberAction extends OrderSetOrderNumberAction implements StagedOrderUpdateAction
{
}
