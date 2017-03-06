<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShoppingLists\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;

/**
 * @package Commercetools\Core\Request\ShoppingLists\Command
 * @link https://dev.commercetools.com/http-api-projects-shoppingLists.html#set-customField
 * @method string getAction()
 * @method ShoppingListSetCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method ShoppingListSetCustomFieldAction setName(string $name = null)
 * @method mixed getValue()
 * @method ShoppingListSetCustomFieldAction setValue($value = null)
 */
class ShoppingListSetCustomFieldAction extends SetCustomFieldAction
{
}
