<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;

/**
 * @package Commercetools\Core\Request\Payments\Command
 * @link https://dev.commercetools.com/http-api-projects-payments.html#set-customfield
 * @method string getAction()
 * @method PaymentSetCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method PaymentSetCustomFieldAction setName(string $name = null)
 * @method mixed getValue()
 * @method PaymentSetCustomFieldAction setValue($value = null)
 */
class PaymentSetCustomFieldAction extends SetCustomFieldAction
{
}
