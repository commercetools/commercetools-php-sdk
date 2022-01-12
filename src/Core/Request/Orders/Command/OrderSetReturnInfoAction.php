<?php

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Order\DeliveryItemCollection;
use Commercetools\Core\Model\Order\ReturnInfoCollection;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 *
 * @link https://docs.commercetools.com/http-api-projects-orders.html#set-delivery-items
 * @method string getAction()
 * @method OrderSetReturnInfoAction setAction(string $action = null)
 * @method string getDeliveryId()
 * @method OrderSetReturnInfoAction setDeliveryId(string $deliveryId = null)
 * @method ReturnInfoCollection getItems()
 * @method OrderSetReturnInfoAction setItems(ReturnInfoCollection $items = null)
 */
class OrderSetReturnInfoAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'items' => [static::TYPE => ReturnInfoCollection::class]
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setReturnInfo');
    }
}
