<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderAddReturnInfoAction;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;
use Commercetools\Core\Model\Order\ReturnItemCollection;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderAddReturnInfoAction setAction(string $action = null)
 * @method DateTimeDecorator getReturnDate()
 * @method StagedOrderAddReturnInfoAction setReturnDate(DateTime $returnDate = null)
 * @method string getReturnTrackingId()
 * @method StagedOrderAddReturnInfoAction setReturnTrackingId(string $returnTrackingId = null)
 * @method ReturnItemCollection getItems()
 * @method StagedOrderAddReturnInfoAction setItems(ReturnItemCollection $items = null)
 */
class StagedOrderAddReturnInfoAction extends OrderAddReturnInfoAction implements StagedOrderUpdateAction
{
}
