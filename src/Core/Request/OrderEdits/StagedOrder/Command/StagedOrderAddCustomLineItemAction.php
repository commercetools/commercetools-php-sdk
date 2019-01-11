<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Carts\Command\CartAddCustomLineItemAction;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderAddCustomLineItemAction setAction(string $action = null)
 * @method LocalizedString getName()
 * @method StagedOrderAddCustomLineItemAction setName(LocalizedString $name = null)
 * @method int getQuantity()
 * @method StagedOrderAddCustomLineItemAction setQuantity(int $quantity = null)
 * @method Money getMoney()
 * @method StagedOrderAddCustomLineItemAction setMoney(Money $money = null)
 * @method string getSlug()
 * @method StagedOrderAddCustomLineItemAction setSlug(string $slug = null)
 * @method TaxCategoryReference getTaxCategory()
 * @method StagedOrderAddCustomLineItemAction setTaxCategory(TaxCategoryReference $taxCategory = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method StagedOrderAddCustomLineItemAction setCustom(CustomFieldObjectDraft $custom = null)
 * @method ExternalTaxRateDraft getExternalTaxRate()
 * @method StagedOrderAddCustomLineItemAction setExternalTaxRate(ExternalTaxRateDraft $externalTaxRate = null)
 */
class StagedOrderAddCustomLineItemAction extends CartAddCustomLineItemAction implements StagedOrderUpdateAction
{

}
