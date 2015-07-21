<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ShippingMethods\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\ShippingMethod\ShippingRate;
use Sphere\Core\Model\Zone\ZoneReference;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\ShippingMethods\Command
 * 
 * @method string getAction()
 * @method ShippingMethodRemoveShippingRateAction setAction(string $action = null)
 * @method ZoneReference getZone()
 * @method ShippingMethodRemoveShippingRateAction setZone(ZoneReference $zone = null)
 * @method ShippingRate getShippingRate()
 * @method ShippingMethodRemoveShippingRateAction setShippingRate(ShippingRate $shippingRate = null)
 */
class ShippingMethodRemoveShippingRateAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'zone' => [static::TYPE => '\Sphere\Core\Model\Zone\ZoneReference'],
            'shippingRate' => [static::TYPE => '\Sphere\Core\Model\ShippingMethod\ShippingRate'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('removeShippingRate');
    }

    /**
     * @param ZoneReference $zone
     * @param ShippingRate $shippingRate
     * @param Context|callable $context
     * @return ShippingMethodRemoveShippingRateAction
     */
    public static function ofZoneAndShippingRate(ZoneReference $zone, ShippingRate $shippingRate, $context = null)
    {
        return static::of($context)->setZone($zone)->setShippingRate($shippingRate);
    }
}
