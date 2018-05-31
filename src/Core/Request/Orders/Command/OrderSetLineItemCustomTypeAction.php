<?php
/**
 *
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Request\Carts\Command\CartSetLineItemCustomTypeAction;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\CustomField\FieldContainer;

/**
 * @package Commercetools\Core\Request\Orders\Command
 *
 * @method string getAction()
 * @method OrderSetLineItemCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method OrderSetLineItemCustomTypeAction setType(TypeReference $type = null)
 * @method string getLineItemId()
 * @method OrderSetLineItemCustomTypeAction setLineItemId(string $lineItemId = null)
 * @method FieldContainer getFields()
 * @method OrderSetLineItemCustomTypeAction setFields(FieldContainer $fields = null)
 */
class OrderSetLineItemCustomTypeAction extends CartSetLineItemCustomTypeAction
{
}
