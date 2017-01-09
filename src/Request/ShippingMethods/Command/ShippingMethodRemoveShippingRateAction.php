<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShippingMethods\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ShippingMethod\ShippingRate;
use Commercetools\Core\Model\Zone\ZoneReference;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ShippingMethods\Command
 * @link https://dev.commercetools.com/http-api-projects-shippingMethods.html#remove-shippingrate
 * @method string getAction()
 * @method ShippingMethodRemoveShippingRateAction setAction(string $action = null)
 * @method ZoneReference getZone()
 * @method ShippingMethodRemoveShippingRateAction setZone(ZoneReference $zone = null)
 * @method ShippingRate getShippingRate()
 * @method ShippingMethodRemoveShippingRateAction setShippingRate(ShippingRate $shippingRate = null)
 */
class ShippingMethodRemoveShippingRateAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'zone' => [static::TYPE => ZoneReference::class],
            'shippingRate' => [static::TYPE => ShippingRate::class],
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
