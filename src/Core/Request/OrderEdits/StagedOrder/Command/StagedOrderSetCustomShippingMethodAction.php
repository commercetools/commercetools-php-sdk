<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Carts\Command\CartSetCustomShippingMethodAction;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;
use Commercetools\Core\Model\ShippingMethod\ShippingRateDraft;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetCustomShippingMethodAction setAction(string $action = null)
 * @method string getShippingMethodName()
 * @method StagedOrderSetCustomShippingMethodAction setShippingMethodName(string $shippingMethodName = null)
 * @method ShippingRateDraft getShippingRate()
 * @method StagedOrderSetCustomShippingMethodAction setShippingRate(ShippingRateDraft $shippingRate = null)
 * @method TaxCategoryReference getTaxCategory()
 * @method StagedOrderSetCustomShippingMethodAction setTaxCategory(TaxCategoryReference $taxCategory = null)
 * @method ExternalTaxRateDraft getExternalTaxRate()
 * @method StagedOrderSetCustomShippingMethodAction setExternalTaxRate(ExternalTaxRateDraft $externalTaxRate = null)
 */
// phpcs:ignore
class StagedOrderSetCustomShippingMethodAction extends CartSetCustomShippingMethodAction implements StagedOrderUpdateAction
{
}
