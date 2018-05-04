<?php
/**
 *
 */

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\CustomField\FieldContainer;

/**
 * @package Commercetools\Core\Request\Customers\Command
 *
 * @method string getAction()
 * @method CustomerSetCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method CustomerSetCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method CustomerSetCustomTypeAction setFields(FieldContainer $fields = null)
 */
class CustomerSetCustomTypeAction extends SetCustomTypeAction
{
}
