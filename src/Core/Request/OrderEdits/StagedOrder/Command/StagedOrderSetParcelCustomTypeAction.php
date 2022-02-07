<?php

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\CustomField\FieldContainer;
use Commercetools\Core\Request\Orders\Command\OrderSetParcelCustomTypeAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetParcelCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method StagedOrderSetParcelCustomTypeAction setType(TypeReference $type = null)
 * @method string getParcelId()
 * @method StagedOrderSetParcelCustomTypeAction setParcelId(string $parcelId = null)
 * @method FieldContainer getFields()
 * @method StagedOrderSetParcelCustomTypeAction setFields(FieldContainer $fields = null)
 */
class StagedOrderSetParcelCustomTypeAction extends OrderSetParcelCustomTypeAction implements StagedOrderUpdateAction
{
}
