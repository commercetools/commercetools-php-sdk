<?php

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\CustomField\FieldContainer;
use Commercetools\Core\Request\Orders\Command\OrderSetReturnItemCustomTypeAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetReturnItemCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method StagedOrderSetReturnItemCustomTypeAction setType(TypeReference $type = null)
 * @method string getReturnItemId()
 * @method StagedOrderSetReturnItemCustomTypeAction setReturnItemId(string $returnItemId = null)
 * @method FieldContainer getFields()
 * @method StagedOrderSetReturnItemCustomTypeAction setFields(FieldContainer $fields = null)
 */
// phpcs:ignore
class StagedOrderSetReturnItemCustomTypeAction extends OrderSetReturnItemCustomTypeAction implements StagedOrderUpdateAction
{
}
