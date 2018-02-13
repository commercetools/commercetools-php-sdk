<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Order\DeliveryItemCollection;
use Commercetools\Core\Model\Order\ParcelCollection;
use Commercetools\Core\Model\Order\ParcelMeasurements;
use Commercetools\Core\Model\Order\TrackingData;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 * @link https://docs.commercetools.com/http-api-projects-orders.html#set-delivery-address
 * @method string getAction()
 * @method OrderSetDeliveryAddressAction setAction(string $action = null)
 * @method string getDeliveryId()
 * @method OrderSetDeliveryAddressAction setDeliveryId(string $deliveryId = null)
 * @method Address getAddress()
 * @method OrderSetDeliveryAddressAction setAddress(Address $address = null)
 */
class OrderSetDeliveryAddressAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'deliveryId' => [static::TYPE => 'string'],
            'address' => [static::TYPE => Address::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setDeliveryAddress');
    }

    /**
     * @param string $deliveryId
     * @param Context|callable $context
     * @return OrderSetDeliveryAddressAction
     */
    public static function ofDeliveryId($deliveryId, $context = null)
    {
        return static::of($context)->setDeliveryId($deliveryId);
    }
}
