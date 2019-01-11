<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderSetCustomTypeAction;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\CustomField\FieldContainer;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method StagedOrderSetCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method StagedOrderSetCustomTypeAction setFields(FieldContainer $fields = null)
 */
class StagedOrderSetCustomTypeAction extends OrderSetCustomTypeAction implements StagedOrderUpdateAction
{
}
