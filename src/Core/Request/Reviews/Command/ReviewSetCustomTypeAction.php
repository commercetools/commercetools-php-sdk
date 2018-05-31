<?php
/**
 *
 */

namespace Commercetools\Core\Request\Reviews\Command;

use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\CustomField\FieldContainer;

/**
 * @package Commercetools\Core\Request\Reviews\Command
 *
 * @method string getAction()
 * @method ReviewSetCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method ReviewSetCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method ReviewSetCustomTypeAction setFields(FieldContainer $fields = null)
 */
class ReviewSetCustomTypeAction extends SetCustomTypeAction
{
}
