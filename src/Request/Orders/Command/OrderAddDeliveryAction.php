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
 * @package Sphere\Core\Request\Orders\Command
 * @link http://dev.sphere.io/http-api-projects-orders.html#add-delivery
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
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addDelivery');
    }

    /**
     * @param DeliveryItemCollection $items
     * @param Context|callable $context
     * @return OrderAddDeliveryAction
     */
    public static function ofDeliveryItems(DeliveryItemCollection $items, $context = null)
    {
        return static::of($context)->setItems($items);
    }
}
