<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Order\DeliveryItemCollection;
use Sphere\Core\Model\Order\ParcelCollection;
use Sphere\Core\Model\Order\ParcelMeasurements;
use Sphere\Core\Model\Order\TrackingData;
use Sphere\Core\Request\AbstractAction;

/**
 * Class OrderAddDeliveryAction
 * @package Sphere\Core\Request\Orders\Command
 * @method string getAction()
 * @method OrderAddDeliveryAction setAction(string $action = null)
 * @method DeliveryItemCollection getItems()
 * @method OrderAddDeliveryAction setItems(DeliveryItemCollection $items = null)
 * @method ParcelCollection getParcels()
 * @method OrderAddDeliveryAction setParcels(ParcelCollection $parcels = null)
 * @method ParcelMeasurements getMeasurements()
 * @method OrderAddDeliveryAction setMeasurements(ParcelMeasurements $measurements = null)
 * @method TrackingData getTrackingData()
 * @method OrderAddDeliveryAction setTrackingData(TrackingData $trackingData = null)
 */
class OrderAddDeliveryAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'items' => [static::TYPE => '\Sphere\Core\Model\Order\DeliveryItemCollection'],
            'parcels' => [static::TYPE => '\Sphere\Core\Model\Order\ParcelCollection'],
            'measurements' => [static::TYPE => '\Sphere\Core\Model\Order\ParcelMeasurements'],
            'trackingData' => [static::TYPE => '\Sphere\Core\Model\Order\TrackingData'],
        ];
    }

    /**
     * @param DeliveryItemCollection $items
     * @param Context $context
     */
    public function __construct(DeliveryItemCollection $items, Context $context = null)
    {
        $this->setContext($context)
            ->setAction('addDelivery')
            ->setItems($items)
        ;
    }
}
