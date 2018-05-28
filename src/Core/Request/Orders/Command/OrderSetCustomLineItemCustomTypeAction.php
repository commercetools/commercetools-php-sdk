<?php
/**
 *
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Request\Carts\Command\CartSetCustomLineItemCustomTypeAction;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\CustomField\FieldContainer;

/**
 * @package Commercetools\Core\Request\Orders\Command
 *
 * @method string getAction()
 * @method OrderSetCustomLineItemCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method OrderSetCustomLineItemCustomTypeAction setType(TypeReference $type = null)
 * @method string getCustomLineItemId()
 * @method OrderSetCustomLineItemCustomTypeAction setCustomLineItemId(string $customLineItemId = null)
 * @method FieldContainer getFields()
 * @method OrderSetCustomLineItemCustomTypeAction setFields(FieldContainer $fields = null)
 */
class OrderSetCustomLineItemCustomTypeAction extends CartSetCustomLineItemCustomTypeAction
{
}
