<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShippingMethods\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Zone\ZoneReference;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ShippingMethods\Command
 * @link https://dev.commercetools.com/http-api-projects-shippingMethods.html#remove-zone
 * @method string getAction()
 * @method ShippingMethodRemoveZoneAction setAction(string $action = null)
 * @method ZoneReference getZone()
 * @method ShippingMethodRemoveZoneAction setZone(ZoneReference $zone = null)
 */
class ShippingMethodRemoveZoneAction extends AbstractAction
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
