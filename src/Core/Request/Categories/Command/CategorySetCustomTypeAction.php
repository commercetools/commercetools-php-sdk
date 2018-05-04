<?php
/**
 *
 */

namespace Commercetools\Core\Request\Categories\Command;

use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\CustomField\FieldContainer;

/**
 * @package Commercetools\Core\Request\Categories\Command
 *
 * @method string getAction()
 * @method CategorySetCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method CategorySetCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method CategorySetCustomTypeAction setFields(FieldContainer $fields = null)
 */
class CategorySetCustomTypeAction extends SetCustomTypeAction
{
}
