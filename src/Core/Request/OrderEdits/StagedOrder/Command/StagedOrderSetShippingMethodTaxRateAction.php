<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Carts\Command\CartSetShippingMethodTaxRateAction;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetShippingMethodTaxRateAction setAction(string $action = null)
 * @method ExternalTaxRateDraft getExternalTaxRate()
 * @method StagedOrderSetShippingMethodTaxRateAction setExternalTaxRate(ExternalTaxRateDraft $externalTaxRate = null)
 */
class StagedOrderSetShippingMethodTaxRateAction extends CartSetShippingMethodTaxRateAction implements StagedOrderUpdateAction
{
}
