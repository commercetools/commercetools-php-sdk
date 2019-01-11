<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Carts\Command\CartSetShippingRateInputAction;
use Commercetools\Core\Model\Cart\ShippingRateInput;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetShippingRateInputAction setAction(string $action = null)
 * @method ShippingRateInput getShippingRateInput()
 * @method StagedOrderSetShippingRateInputAction setShippingRateInput(ShippingRateInput $shippingRateInput = null)
 */
class StagedOrderSetShippingRateInputAction extends CartSetShippingRateInputAction implements StagedOrderUpdateAction
{

}
