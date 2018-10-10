<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Orders\Command\OrderSetLineItemCustomTypeAction;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\CustomField\FieldContainer;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderSetLineItemCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method StagedOrderSetLineItemCustomTypeAction setType(TypeReference $type = null)
 * @method string getLineItemId()
 * @method StagedOrderSetLineItemCustomTypeAction setLineItemId(string $lineItemId = null)
 * @method FieldContainer getFields()
 * @method StagedOrderSetLineItemCustomTypeAction setFields(FieldContainer $fields = null)
 */
class StagedOrderSetLineItemCustomTypeAction extends OrderSetLineItemCustomTypeAction implements StagedOrderUpdateAction
{
}
