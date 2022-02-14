<?php

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderSetDeliveryCustomTypeAction;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\CustomField\FieldContainer;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetDeliveryCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method StagedOrderSetDeliveryCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method StagedOrderSetDeliveryCustomTypeAction setFields(FieldContainer $fields = null)
 */
class StagedOrderSetDeliveryCustomTypeAction extends OrderSetDeliveryCustomTypeAction implements StagedOrderUpdateAction
{
}
