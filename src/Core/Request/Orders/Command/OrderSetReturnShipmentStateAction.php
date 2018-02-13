<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 * @link https://docs.commercetools.com/http-api-projects-orders.html#set-returnshipmentstate
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

    public function fieldDefinitions()
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
