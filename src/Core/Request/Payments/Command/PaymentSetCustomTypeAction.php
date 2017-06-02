<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\CustomField\FieldContainer;
use Commercetools\Core\Model\Type\TypeReference;

/**
 * @package Commercetools\Core\Request\Payments\Command
 * @link https://dev.commercetools.com/http-api-projects-payments.html#set-custom-type
 * @method string getAction()
 * @method PaymentSetCustomTypeAction setAction(string $action = null)
 * @method string getTypeId()
 * @method PaymentSetCustomTypeAction setTypeId(string $typeId = null)
 * @method string getTypeKey()
 * @method PaymentSetCustomTypeAction setTypeKey(string $typeKey = null)
 * @method FieldContainer getFields()
 * @method PaymentSetCustomTypeAction setFields(FieldContainer $fields = null)
 * @method TypeReference getType()
 * @method PaymentSetCustomTypeAction setType(TypeReference $type = null)
 */
class PaymentSetCustomTypeAction extends SetCustomTypeAction
{
}
