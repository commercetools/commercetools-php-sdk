<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ShippingMethods\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Zone\ZoneReference;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ShippingMethodRemoveZoneAction
 * @package Sphere\Core\Request\ShippingMethods\Command
 * 
 * @method string getAction()
 * @method ShippingMethodRemoveZoneAction setAction(string $action = null)
 * @method ZoneReference getZone()
 * @method ShippingMethodRemoveZoneAction setZone(ZoneReference $zone = null)
 */
class ShippingMethodRemoveZoneAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'zone' => [static::TYPE => '\Sphere\Core\Model\Zone\ZoneReference'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('removeZone');
    }

    /**
     * @param ZoneReference $zone
     * @param Context|callable $context
     * @return ShippingMethodRemoveZoneAction
     */
    public static function ofZone(ZoneReference $zone, $context = null)
    {
        return static::of($context)->setZone($zone);
    }
}
