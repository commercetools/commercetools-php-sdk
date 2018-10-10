<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Orders\Command\OrderSetDeliveryAddressAction;
use Commercetools\Core\Model\Common\Address;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderSetDeliveryAddressAction setAction(string $action = null)
 * @method string getDeliveryId()
 * @method StagedOrderSetDeliveryAddressAction setDeliveryId(string $deliveryId = null)
 * @method Address getAddress()
 * @method StagedOrderSetDeliveryAddressAction setAddress(Address $address = null)
 */
class StagedOrderSetDeliveryAddressAction extends OrderSetDeliveryAddressAction implements StagedOrderUpdateAction
{
}
