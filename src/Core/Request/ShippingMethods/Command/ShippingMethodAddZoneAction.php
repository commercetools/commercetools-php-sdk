<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShippingMethods\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Zone\ZoneReference;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ShippingMethods\Command
 * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#add-zone
 * @method string getAction()
 * @method ShippingMethodAddZoneAction setAction(string $action = null)
 * @method ZoneReference getZone()
 * @method ShippingMethodAddZoneAction setZone(ZoneReference $zone = null)
 */
class ShippingMethodAddZoneAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'zone' => [static::TYPE => ZoneReference::class],
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
