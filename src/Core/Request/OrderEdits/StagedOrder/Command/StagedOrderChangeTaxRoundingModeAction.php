<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Carts\Command\CartChangeTaxRoundingModeAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderChangeTaxRoundingModeAction setAction(string $action = null)
 * @method string getTaxRoundingMode()
 * @method StagedOrderChangeTaxRoundingModeAction setTaxRoundingMode(string $taxRoundingMode = null)
 */
class StagedOrderChangeTaxRoundingModeAction extends CartChangeTaxRoundingModeAction implements StagedOrderUpdateAction
{

}
