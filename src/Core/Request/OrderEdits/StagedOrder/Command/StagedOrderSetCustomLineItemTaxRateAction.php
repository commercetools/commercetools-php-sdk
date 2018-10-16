<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Carts\Command\CartSetCustomLineItemTaxRateAction;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetCustomLineItemTaxRateAction setAction(string $action = null)
 * @method string getCustomLineItemId()
 * @method StagedOrderSetCustomLineItemTaxRateAction setCustomLineItemId(string $customLineItemId = null)
 * @method ExternalTaxRateDraft getExternalTaxRate()
 * @method StagedOrderSetCustomLineItemTaxRateAction setExternalTaxRate(ExternalTaxRateDraft $externalTaxRate = null)
 */
class StagedOrderSetCustomLineItemTaxRateAction extends CartSetCustomLineItemTaxRateAction implements StagedOrderUpdateAction
{

}
