<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Carts\Command\CartChangeCustomLineItemMoneyAction;
use Commercetools\Core\Model\Common\Money;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderChangeCustomLineItemMoneyAction setAction(string $action = null)
 * @method string getCustomLineItemId()
 * @method StagedOrderChangeCustomLineItemMoneyAction setCustomLineItemId(string $customLineItemId = null)
 * @method Money getMoney()
 * @method StagedOrderChangeCustomLineItemMoneyAction setMoney(Money $money = null)
 */
class StagedOrderChangeCustomLineItemMoneyAction extends CartChangeCustomLineItemMoneyAction implements StagedOrderUpdateAction
{

}
