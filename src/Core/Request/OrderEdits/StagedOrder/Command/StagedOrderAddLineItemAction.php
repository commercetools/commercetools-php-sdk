<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Carts\Command\CartAddLineItemAction;
use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Cart\ExternalLineItemTotalPrice;
use Commercetools\Core\Model\Cart\ItemShippingDetailsDraft;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderAddLineItemAction setAction(string $action = null)
 * @method string getProductId()
 * @method StagedOrderAddLineItemAction setProductId(string $productId = null)
 * @method int getVariantId()
 * @method StagedOrderAddLineItemAction setVariantId(int $variantId = null)
 * @method string getSku()
 * @method StagedOrderAddLineItemAction setSku(string $sku = null)
 * @method int getQuantity()
 * @method StagedOrderAddLineItemAction setQuantity(int $quantity = null)
 * @method ChannelReference getSupplyChannel()
 * @method StagedOrderAddLineItemAction setSupplyChannel(ChannelReference $supplyChannel = null)
 * @method ChannelReference getDistributionChannel()
 * @method StagedOrderAddLineItemAction setDistributionChannel(ChannelReference $distributionChannel = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method StagedOrderAddLineItemAction setCustom(CustomFieldObjectDraft $custom = null)
 * @method ExternalTaxRateDraft getExternalTaxRate()
 * @method StagedOrderAddLineItemAction setExternalTaxRate(ExternalTaxRateDraft $externalTaxRate = null)
 * @method Money getExternalPrice()
 * @method StagedOrderAddLineItemAction setExternalPrice(Money $externalPrice = null)
 * @method ExternalLineItemTotalPrice getExternalTotalPrice()
 * @method StagedOrderAddLineItemAction setExternalTotalPrice(ExternalLineItemTotalPrice $externalTotalPrice = null)
 * @method ItemShippingDetailsDraft getShippingDetails()
 * @method StagedOrderAddLineItemAction setShippingDetails(ItemShippingDetailsDraft $shippingDetails = null)
 */
class StagedOrderAddLineItemAction extends CartAddLineItemAction implements StagedOrderUpdateAction
{

}
