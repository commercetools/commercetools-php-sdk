<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Orders\Command\OrderSetCustomerEmail;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderSetCustomerEmailAction setAction(string $action = null)
 * @method string getEmail()
 * @method StagedOrderSetCustomerEmailAction setEmail(string $email = null)
 */
class StagedOrderSetCustomerEmailAction extends OrderSetCustomerEmail implements StagedOrderUpdateAction
{
}
