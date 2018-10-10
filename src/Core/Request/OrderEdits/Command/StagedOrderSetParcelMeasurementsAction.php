<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Orders\Command\OrderSetParcelMeasurementsAction;
use Commercetools\Core\Model\Order\ParcelMeasurements;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderSetParcelMeasurementsAction setAction(string $action = null)
 * @method string getParcelId()
 * @method StagedOrderSetParcelMeasurementsAction setParcelId(string $parcelId = null)
 * @method ParcelMeasurements getMeasurements()
 * @method StagedOrderSetParcelMeasurementsAction setMeasurements(ParcelMeasurements $measurements = null)
 */
class StagedOrderSetParcelMeasurementsAction extends OrderSetParcelMeasurementsAction implements StagedOrderUpdateAction
{
}
