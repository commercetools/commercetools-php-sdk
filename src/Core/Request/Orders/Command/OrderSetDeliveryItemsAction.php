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
 * @method string getAction()
 * @method OrderSetDeliveryItemsAction setAction(string $action = null)
 * @method string getDeliveryId()
 * @method OrderSetDeliveryItemsAction setDeliveryId(string $deliveryId = null)
 * @method DeliveryItemCollection getItems()
 * @method OrderSetDeliveryItemsAction setItems(DeliveryItemCollection $items = null)
 */
class OrderSetDeliveryItemsAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'deliveryId' => [static::TYPE => 'string'],
            'items' => [static::TYPE => DeliveryItemCollection::class]
        ];
    }

    /**
     * @param string $deliveryId
     * @param DeliveryItemCollection $items
     * @param Context|callable $context
     * @return OrderSetDeliveryItemsAction
     */
    public static function ofDeliveryAndItems($deliveryId, DeliveryItemCollection $items, $context = null)
    {
        return static::of($context)->setDeliveryId($deliveryId)->setItems($items);
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setDeliveryItems');
    }
}
