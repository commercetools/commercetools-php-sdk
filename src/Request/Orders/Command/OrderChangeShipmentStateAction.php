<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 * @apidoc http://dev.sphere.io/http-api-projects-orders.html#change-shipment-state
 * @method string getAction()
 * @method OrderChangeShipmentStateAction setAction(string $action = null)
 * @method string getShipmentState()
 * @method OrderChangeShipmentStateAction setShipmentState(string $shipmentState = null)
 */
class OrderChangeShipmentStateAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'shipmentState' => [static::TYPE => 'string']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeShipmentState');
    }

    /**
     * @param string $shipmentState
     * @param Context|callable $context
     * @return OrderChangeShipmentStateAction
     */
    public static function ofShipmentState($shipmentState, $context = null)
    {
        return static::of($context)->setShipmentState($shipmentState);
    }
}
