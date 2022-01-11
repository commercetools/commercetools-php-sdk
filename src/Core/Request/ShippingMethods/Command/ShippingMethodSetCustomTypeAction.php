<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShippingMethods\Command;

use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\CustomField\FieldContainer;

/**
 * @package Commercetools\Core\Request\ShippingMethods\Command
 * @link https://docs.commercetools.com/api/projects/shippingMethods#set-customtype
 * @method string getAction()
 * @method ShippingMethodSetCustomTypeAction setAction(string $action = null)
 * @method string getCustomType()
 * @method ShippingMethodSetCustomTypeAction setCustomType(string $predicate = null)
 * @method TypeReference getType()
 * @method ShippingMethodSetCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method ShippingMethodSetCustomTypeAction setFields(FieldContainer $fields = null)
 */
class ShippingMethodSetCustomTypeAction extends SetCustomTypeAction
{
}
