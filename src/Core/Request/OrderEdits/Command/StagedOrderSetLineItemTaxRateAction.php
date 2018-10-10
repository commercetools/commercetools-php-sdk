<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Carts\Command\CartSetLineItemTaxRateAction;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderSetLineItemTaxRateAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method StagedOrderSetLineItemTaxRateAction setLineItemId(string $lineItemId = null)
 * @method ExternalTaxRateDraft getExternalTaxRate()
 * @method StagedOrderSetLineItemTaxRateAction setExternalTaxRate(ExternalTaxRateDraft $externalTaxRate = null)
 */
class StagedOrderSetLineItemTaxRateAction extends CartSetLineItemTaxRateAction implements StagedOrderUpdateAction
{

}
