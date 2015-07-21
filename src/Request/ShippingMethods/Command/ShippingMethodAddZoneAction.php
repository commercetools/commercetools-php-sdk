<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ShippingMethods\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Zone\ZoneReference;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\ShippingMethods\Command
 * 
 * @method string getAction()
 * @method ShippingMethodAddZoneAction setAction(string $action = null)
 * @method ZoneReference getZone()
 * @method ShippingMethodAddZoneAction setZone(ZoneReference $zone = null)
 */
class ShippingMethodAddZoneAction extends AbstractAction
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
        $this->setAction('addZone');
    }

    /**
     * @param ZoneReference $zone
     * @param Context|callable $context
     * @return ShippingMethodAddZoneAction
     */
    public static function ofZone(ZoneReference $zone, $context = null)
    {
        return static::of($context)->setZone($zone);
    }
}
