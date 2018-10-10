<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Carts\Command\CartSetShippingMethodAction;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodReference;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderSetShippingMethodAction setAction(string $action = null)
 * @method ShippingMethodReference getShippingMethod()
 * @method StagedOrderSetShippingMethodAction setShippingMethod(ShippingMethodReference $shippingMethod = null)
 */
class StagedOrderSetShippingMethodAction extends CartSetShippingMethodAction implements StagedOrderUpdateAction
{

}
