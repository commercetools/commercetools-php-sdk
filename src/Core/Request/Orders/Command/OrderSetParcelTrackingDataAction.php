<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Order\TrackingData;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 *
 * @method string getAction()
 * @method OrderSetParcelTrackingDataAction setAction(string $action = null)
 * @method string getParcelId()
 * @method OrderSetParcelTrackingDataAction setParcelId(string $parcelId = null)
 * @method TrackingData getTrackingData()
 * @method OrderSetParcelTrackingDataAction setTrackingData(TrackingData $trackingData = null)
 */
class OrderSetParcelTrackingDataAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'parcelId' => [static::TYPE => 'string'],
            'trackingData' => [static::TYPE => TrackingData::class]
        ];
    }

    /**
     * @param string $parcelId
     * @param Context|callable $context
     * @return OrderSetParcelTrackingDataAction
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
        $this->setAction('setParcelTrackingData');
    }
}
