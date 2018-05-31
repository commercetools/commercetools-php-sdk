<?php
/**
 *
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\CustomField\FieldContainer;

/**
 * @package Commercetools\Core\Request\Orders\Command
 *
 * @method string getAction()
 * @method OrderSetCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method OrderSetCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method OrderSetCustomTypeAction setFields(FieldContainer $fields = null)
 */
class OrderSetCustomTypeAction extends SetCustomTypeAction
{
}
