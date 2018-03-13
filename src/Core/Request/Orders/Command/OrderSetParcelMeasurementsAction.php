<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Order\DeliveryItemCollection;
use Commercetools\Core\Model\Order\ParcelMeasurements;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 *
 * @method string getAction()
 * @method OrderSetParcelMeasurementsAction setAction(string $action = null)
 * @method string getParcelId()
 * @method OrderSetParcelMeasurementsAction setParcelId(string $parcelId = null)
 * @method ParcelMeasurements getMeasurements()
 * @method OrderSetParcelMeasurementsAction setMeasurements(ParcelMeasurements $measurements = null)
 */
class OrderSetParcelMeasurementsAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'parcelId' => [static::TYPE => 'string'],
            'measurements' => [static::TYPE => ParcelMeasurements::class]
        ];
    }

    /**
     * @param string $parcelId
     * @param Context|callable $context
     * @return OrderSetParcelMeasurementsAction
     */
    public static function ofParcel($parcelId, $context = null)
    {
        return static::of($context)->setParcelId($parcelId);
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setParcelMeasurements');
    }
}
