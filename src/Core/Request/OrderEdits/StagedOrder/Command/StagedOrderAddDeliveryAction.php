<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderAddDeliveryAction;
use Commercetools\Core\Model\Order\DeliveryItemCollection;
use Commercetools\Core\Model\Order\ParcelCollection;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\CustomField\CustomFieldObject;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderAddDeliveryAction setAction(string $action = null)
 * @method DeliveryItemCollection getItems()
 * @method StagedOrderAddDeliveryAction setItems(DeliveryItemCollection $items = null)
 * @method ParcelCollection getParcels()
 * @method StagedOrderAddDeliveryAction setParcels(ParcelCollection $parcels = null)
 * @method Address getAddress()
 * @method StagedOrderAddDeliveryAction setAddress(Address $address = null)
 * @method CustomFieldObject getCustom()
 * @method StagedOrderAddDeliveryAction setCustom(CustomFieldObject $custom = null)
 */
class StagedOrderAddDeliveryAction extends OrderAddDeliveryAction implements StagedOrderUpdateAction
{
}
