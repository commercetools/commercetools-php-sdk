<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Order\DeliveryItemCollection;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 *
 * @link https://docs.commercetools.com/http-api-projects-orders.html#remove-delivery
 * @method string getAction()
 * @method OrderRemoveDeliveryAction setAction(string $action = null)
 * @method string getDeliveryId()
 * @method OrderRemoveDeliveryAction setDeliveryId(string $deliveryId = null)
 */
class OrderRemoveDeliveryAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'deliveryId' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param string $deliveryId
     * @param Context|callable $context
     * @return OrderRemoveDeliveryAction
     */
    public static function ofDelivery($deliveryId, $context = null)
    {
        return static::of($context)->setDeliveryId($deliveryId);
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('removeDelivery');
    }
}
