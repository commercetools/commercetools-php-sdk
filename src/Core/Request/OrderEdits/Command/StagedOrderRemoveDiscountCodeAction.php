<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Carts\Command\CartRemoveDiscountCodeAction;
use Commercetools\Core\Model\DiscountCode\DiscountCodeReference;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderRemoveDiscountCodeAction setAction(string $action = null)
 * @method DiscountCodeReference getDiscountCode()
 * @method StagedOrderRemoveDiscountCodeAction setDiscountCode(DiscountCodeReference $discountCode = null)
 */
class StagedOrderRemoveDiscountCodeAction extends CartRemoveDiscountCodeAction implements StagedOrderUpdateAction
{

}
