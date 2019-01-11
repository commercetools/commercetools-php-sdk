<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\CustomField\FieldContainer;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method OrderEditSetCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method OrderEditSetCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method OrderEditSetCustomTypeAction setFields(FieldContainer $fields = null)
 */
class OrderEditSetCustomTypeAction extends SetCustomTypeAction
{
}
