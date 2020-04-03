<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderAddParcelToDeliveryAction;
use Commercetools\Core\Model\Order\ParcelMeasurements;
use Commercetools\Core\Model\Order\TrackingData;
use Commercetools\Core\Model\Order\DeliveryItemCollection;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderAddParcelToDeliveryAction setAction(string $action = null)
 * @method string getDeliveryId()
 * @method StagedOrderAddParcelToDeliveryAction setDeliveryId(string $deliveryId = null)
 * @method ParcelMeasurements getMeasurements()
 * @method StagedOrderAddParcelToDeliveryAction setMeasurements(ParcelMeasurements $measurements = null)
 * @method TrackingData getTrackingData()
 * @method StagedOrderAddParcelToDeliveryAction setTrackingData(TrackingData $trackingData = null)
 * @method DeliveryItemCollection getItems()
 * @method StagedOrderAddParcelToDeliveryAction setItems(DeliveryItemCollection $items = null)
 */
class StagedOrderAddParcelToDeliveryAction extends OrderAddParcelToDeliveryAction implements StagedOrderUpdateAction
{
}
