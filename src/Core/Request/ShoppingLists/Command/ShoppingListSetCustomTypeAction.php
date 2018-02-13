<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShoppingLists\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\CustomField\FieldContainer;

/**
 * @package Commercetools\Core\Request\ShoppingLists\Command
 * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-customType
 * @method string getAction()
 * @method ShoppingListSetCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method ShoppingListSetCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method ShoppingListSetCustomTypeAction setFields(FieldContainer $fields = null)
 */
class ShoppingListSetCustomTypeAction extends SetCustomTypeAction
{
}
