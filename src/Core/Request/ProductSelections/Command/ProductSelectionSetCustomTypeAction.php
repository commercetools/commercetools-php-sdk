<?php

namespace Commercetools\Core\Request\ProductSelections\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\CustomField\FieldContainer;
use Commercetools\Core\Model\Type\TypeReference;

/**
 * @package Commercetools\Core\Request\ProductSelections\Command
 * @link https://docs.commercetools.com/http-api-projects-productselections.html#set-custom-type
 * @method string getAction()
 * @method ProductSelectionSetCustomTypeAction setAction(string $action = null)
 * @method string getTypeId()
 * @method ProductSelectionSetCustomTypeAction setTypeId(string $typeId = null)
 * @method string getTypeKey()
 * @method ProductSelectionSetCustomTypeAction setTypeKey(string $typeKey = null)
 * @method FieldContainer getFields()
 * @method ProductSelectionSetCustomTypeAction setFields(FieldContainer $fields = null)
 * @method TypeReference getType()
 * @method ProductSelectionSetCustomTypeAction setType(TypeReference $type = null)
 */
class ProductSelectionSetCustomTypeAction extends SetCustomTypeAction
{
}
