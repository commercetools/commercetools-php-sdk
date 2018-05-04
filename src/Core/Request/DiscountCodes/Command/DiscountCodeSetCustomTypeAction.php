<?php
/**
 *
 */

namespace Commercetools\Core\Request\DiscountCodes\Command;

use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\CustomField\FieldContainer;

/**
 * @package Commercetools\Core\Request\DiscountCodes\Command
 *
 * @method string getAction()
 * @method DiscountCodeSetCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method DiscountCodeSetCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method DiscountCodeSetCustomTypeAction setFields(FieldContainer $fields = null)
 */
class DiscountCodeSetCustomTypeAction extends SetCustomTypeAction
{
}
