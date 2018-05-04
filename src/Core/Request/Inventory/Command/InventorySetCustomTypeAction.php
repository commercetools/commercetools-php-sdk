<?php
/**
 *
 */

namespace Commercetools\Core\Request\Inventory\Command;

use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\CustomField\FieldContainer;

/**
 * @package Commercetools\Core\Request\Inventory\Command
 *
 * @method string getAction()
 * @method InventorySetCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method InventorySetCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method InventorySetCustomTypeAction setFields(FieldContainer $fields = null)
 */
class InventorySetCustomTypeAction extends SetCustomTypeAction
{
}
