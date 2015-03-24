<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class OrderSetReturnShipmentStateAction
 * @package Sphere\Core\Request\Orders\Command
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
     * @param string $returnItemId
     * @param string $shipmentState
     * @param Context $context
     */
    public function __construct($returnItemId, $shipmentState, Context $context = null)
    {
        $this->setContext($context)
            ->setAction('setReturnShipmentState')
            ->setReturnItemId($returnItemId)
            ->setShipmentState($shipmentState);
    }

    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'returnItemId' => [static::TYPE => 'string'],
            'shipmentState' => [static::TYPE => 'string']
        ];
    }
}
