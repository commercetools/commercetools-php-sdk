<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Carts\Command\CartAddDiscountCodeAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderAddDiscountCodeAction setAction(string $action = null)
 * @method string getCode()
 * @method StagedOrderAddDiscountCodeAction setCode(string $code = null)
 */
class StagedOrderAddDiscountCodeAction extends CartAddDiscountCodeAction implements StagedOrderUpdateAction
{
}
