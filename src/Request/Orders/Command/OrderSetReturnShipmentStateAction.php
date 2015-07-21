<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\Orders\Command
 * @link http://dev.sphere.io/http-api-projects-orders.html#set-return-shipment-state
 * @method string getAction()
 * @method OrderSetReturnShipmentStateAction setAction(string $action = null)
 * @method string getReturnItemId()
 * @method OrderSetReturnShipmentStateAction setReturnItemId(string $returnItemId = null)
 * @method string getShipmentState()
 * @method OrderSetReturnShipmentStateAction setShipmentState(string $shipmentState = null)
 */
class OrderSetReturnShipmentStateAction extends AbstractAction
{
    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setReturnShipmentState');
    }

    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'returnItemId' => [static::TYPE => 'string'],
            'shipmentState' => [static::TYPE => 'string']
        ];
    }

    /**
     * @param $returnItemId
     * @param $shipmentState
     * @param Context|callable $context
     * @return OrderSetReturnShipmentStateAction
     */
    public static function ofReturnItemIdAndShipmentState($returnItemId, $shipmentState, $context = null)
    {
        return static::of($context)->setReturnItemId($returnItemId)->setShipmentState($shipmentState);
    }
}
