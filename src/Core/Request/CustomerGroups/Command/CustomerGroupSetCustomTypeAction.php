<?php
/**
 *
 */

namespace Commercetools\Core\Request\CustomerGroups\Command;

use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\CustomField\FieldContainer;

/**
 * @package Commercetools\Core\Request\CustomerGroups\Command
 *
 * @method string getAction()
 * @method CustomerGroupSetCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method CustomerGroupSetCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method CustomerGroupSetCustomTypeAction setFields(FieldContainer $fields = null)
 */
class CustomerGroupSetCustomTypeAction extends SetCustomTypeAction
{
}
