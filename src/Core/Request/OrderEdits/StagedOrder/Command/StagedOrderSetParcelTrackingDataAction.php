<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderSetParcelTrackingDataAction;
use Commercetools\Core\Model\Order\TrackingData;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetParcelTrackingDataAction setAction(string $action = null)
 * @method string getParcelId()
 * @method StagedOrderSetParcelTrackingDataAction setParcelId(string $parcelId = null)
 * @method TrackingData getTrackingData()
 * @method StagedOrderSetParcelTrackingDataAction setTrackingData(TrackingData $trackingData = null)
 */
class StagedOrderSetParcelTrackingDataAction extends OrderSetParcelTrackingDataAction implements StagedOrderUpdateAction
{

}
