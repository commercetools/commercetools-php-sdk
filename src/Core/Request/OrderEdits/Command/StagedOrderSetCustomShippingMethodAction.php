<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Carts\Command\CartSetCustomShippingMethodAction;
use Commercetools\Core\Model\ShippingMethod\ShippingRate;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderSetCustomShippingMethodAction setAction(string $action = null)
 * @method string getShippingMethodName()
 * @method StagedOrderSetCustomShippingMethodAction setShippingMethodName(string $shippingMethodName = null)
 * @method ShippingRate getShippingRate()
 * @method StagedOrderSetCustomShippingMethodAction setShippingRate(ShippingRate $shippingRate = null)
 * @method TaxCategoryReference getTaxCategory()
 * @method StagedOrderSetCustomShippingMethodAction setTaxCategory(TaxCategoryReference $taxCategory = null)
 * @method ExternalTaxRateDraft getExternalTaxRate()
 * @method StagedOrderSetCustomShippingMethodAction setExternalTaxRate(ExternalTaxRateDraft $externalTaxRate = null)
 */
class StagedOrderSetCustomShippingMethodAction extends CartSetCustomShippingMethodAction implements StagedOrderUpdateAction
{

}
