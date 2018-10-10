<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Carts\Command\CartChangeTaxCalculationModeAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderChangeTaxCalculationModeAction setAction(string $action = null)
 * @method string getTaxCalculationMode()
 * @method StagedOrderChangeTaxCalculationModeAction setTaxCalculationMode(string $taxCalculationMode = null)
 */
class StagedOrderChangeTaxCalculationModeAction extends CartChangeTaxCalculationModeAction implements StagedOrderUpdateAction
{

}
