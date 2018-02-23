<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Order\DeliveryItemCollection;
use Commercetools\Core\Model\Order\ParcelMeasurements;
use Commercetools\Core\Model\Order\TrackingData;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 * @link https://docs.commercetools.com/http-api-projects-orders.html#add-parcel
 * @method string getAction()
 * @method OrderAddParcelToDeliveryAction setAction(string $action = null)
 * @method string getDeliveryId()
 * @method OrderAddParcelToDeliveryAction setDeliveryId(string $deliveryId = null)
 * @method ParcelMeasurements getMeasurements()
 * @method OrderAddParcelToDeliveryAction setMeasurements(ParcelMeasurements $measurements = null)
 * @method TrackingData getTrackingData()
 * @method OrderAddParcelToDeliveryAction setTrackingData(TrackingData $trackingData = null)
 * @method DeliveryItemCollection getItems()
 * @method OrderAddParcelToDeliveryAction setItems(DeliveryItemCollection $items = null)
 */
class OrderAddParcelToDeliveryAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'deliveryId' => [static::TYPE => 'string'],
            'measurements' => [static::TYPE => ParcelMeasurements::class],
            'trackingData' => [static::TYPE => TrackingData::class],
            'items' => [static::TYPE => DeliveryItemCollection::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addParcelToDelivery');
    }

    /**
     * @param string $deliveryId
     * @param Context|callable $context
     * @return OrderAddParcelToDeliveryAction
     */
    public static function ofDeliveryId($deliveryId, $context = null)
    {
        return static::of($context)->setDeliveryId($deliveryId);
    }
}
