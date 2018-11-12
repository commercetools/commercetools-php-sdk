<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Carts\Command\CartChangeTaxModeAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderChangeTaxModeAction setAction(string $action = null)
 * @method string getTaxMode()
 * @method StagedOrderChangeTaxModeAction setTaxMode(string $taxMode = null)
 */
class StagedOrderChangeTaxModeAction extends CartChangeTaxModeAction implements StagedOrderUpdateAction
{

}
