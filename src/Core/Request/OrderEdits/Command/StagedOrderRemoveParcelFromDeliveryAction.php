<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Orders\Command\OrderRemoveParcelFromDeliveryAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderRemoveParcelFromDeliveryAction setAction(string $action = null)
 * @method string getParcelId()
 * @method StagedOrderRemoveParcelFromDeliveryAction setParcelId(string $parcelId = null)
 */
class StagedOrderRemoveParcelFromDeliveryAction extends OrderRemoveParcelFromDeliveryAction implements StagedOrderUpdateAction
{
}
