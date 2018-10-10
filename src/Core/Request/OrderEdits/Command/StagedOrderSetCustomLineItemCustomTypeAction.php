<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Orders\Command\OrderSetCustomLineItemCustomTypeAction;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\CustomField\FieldContainer;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderSetCustomLineItemCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method StagedOrderSetCustomLineItemCustomTypeAction setType(TypeReference $type = null)
 * @method string getCustomLineItemId()
 * @method StagedOrderSetCustomLineItemCustomTypeAction setCustomLineItemId(string $customLineItemId = null)
 * @method FieldContainer getFields()
 * @method StagedOrderSetCustomLineItemCustomTypeAction setFields(FieldContainer $fields = null)
 */
class StagedOrderSetCustomLineItemCustomTypeAction extends OrderSetCustomLineItemCustomTypeAction implements StagedOrderUpdateAction
{
}
