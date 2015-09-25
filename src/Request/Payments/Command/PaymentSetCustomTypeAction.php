<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\CustomField\FieldContainer;

/**
 * @package Commercetools\Core\Request\Payments\Command
 *
 * @method string getAction()
 * @method PaymentSetCustomTypeAction setAction(string $action = null)
 * @method string getTypeId()
 * @method PaymentSetCustomTypeAction setTypeId(string $typeId = null)
 * @method string getTypeKey()
 * @method PaymentSetCustomTypeAction setTypeKey(string $typeKey = null)
 * @method FieldContainer getFields()
 * @method PaymentSetCustomTypeAction setFields(FieldContainer $fields = null)
 */
class PaymentSetCustomTypeAction extends SetCustomTypeAction
{
}
