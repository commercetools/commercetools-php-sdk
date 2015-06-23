<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class OrderChangeShipmentStateAction
 * @package Sphere\Core\Request\Orders\Command
 * @link http://dev.sphere.io/http-api-projects-orders.html#change-shipment-state
 * @method string getAction()
 * @method OrderChangeShipmentStateAction setAction(string $action = null)
 * @method string getShipmentState()
 * @method OrderChangeShipmentStateAction setShipmentState(string $shipmentState = null)
 */
class OrderChangeShipmentStateAction extends AbstractAction
{
    public function getFields()
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
