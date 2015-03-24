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
 * @method string getAction()
 * @method OrderChangeShipmentStateAction setAction(string $action = null)
 * @method string getShipmentState()
 * @method OrderChangeShipmentStateAction setShipmentState(string $shipmentState = null)
 */
class OrderChangeShipmentStateAction extends AbstractAction
{
    /**
     * @param array $shipmentState
     * @param Context $context
     */
    public function __construct($shipmentState, Context $context = null)
    {
        $this->setContext($context)
            ->setAction('changeShipmentState')
            ->setShipmentState($shipmentState);
    }

    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'shipmentState' => [static::TYPE => 'string']
        ];
    }
}
