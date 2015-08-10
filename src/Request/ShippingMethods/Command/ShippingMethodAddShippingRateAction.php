<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShippingMethods\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ShippingMethod\ShippingRate;
use Commercetools\Core\Model\Zone\ZoneReference;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ShippingMethods\Command
 *
 * @method string getAction()
 * @method ShippingMethodAddShippingRateAction setAction(string $action = null)
 * @method ZoneReference getZone()
 * @method ShippingMethodAddShippingRateAction setZone(ZoneReference $zone = null)
 * @method ShippingRate getShippingRate()
 * @method ShippingMethodAddShippingRateAction setShippingRate(ShippingRate $shippingRate = null)
 */
class ShippingMethodAddShippingRateAction extends AbstractAction
{
    public function getPropertyDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'zone' => [static::TYPE => '\Commercetools\Core\Model\Zone\ZoneReference'],
            'shippingRate' => [static::TYPE => '\Commercetools\Core\Model\ShippingMethod\ShippingRate'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addShippingRate');
    }

    /**
     * @param ZoneReference $zone
     * @param ShippingRate $shippingRate
     * @param Context|callable $context
     * @return ShippingMethodAddShippingRateAction
     */
    public static function ofZoneAndShippingRate(ZoneReference $zone, ShippingRate $shippingRate, $context = null)
    {
        return static::of($context)->setZone($zone)->setShippingRate($shippingRate);
    }
}
