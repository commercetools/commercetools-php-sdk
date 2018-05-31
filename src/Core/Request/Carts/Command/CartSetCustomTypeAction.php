<?php
/**
 *
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\CustomField\FieldContainer;

/**
 * @package Commercetools\Core\Request\Carts\Command
 *
 * @method string getAction()
 * @method CartSetCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method CartSetCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method CartSetCustomTypeAction setFields(FieldContainer $fields = null)
 */
class CartSetCustomTypeAction extends SetCustomTypeAction
{
}
