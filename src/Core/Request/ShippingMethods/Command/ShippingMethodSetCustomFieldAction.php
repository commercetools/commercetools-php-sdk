<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShippingMethods\Command;

use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;

/**
 * @package Commercetools\Core\Request\ShippingMethods\Command
 * @link https://docs.commercetools.com/api/projects/shippingMethods#set-customfield
 * @method string getAction()
 * @method ShippingMethodSetCustomFieldAction setAction(string $action = null)
 * @method string getCustomField()
 * @method ShippingMethodSetCustomFieldAction setCustomField(string $predicate = null)
 * @method string getName()
 * @method ShippingMethodSetCustomFieldAction setName(string $name = null)
 * @method mixed getValue()
 * @method ShippingMethodSetCustomFieldAction setValue($value = null)
 */
class ShippingMethodSetCustomFieldAction extends SetCustomFieldAction
{
}
