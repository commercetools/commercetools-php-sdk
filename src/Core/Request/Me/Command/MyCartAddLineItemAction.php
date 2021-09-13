<?php

namespace Commercetools\Core\Request\Me\Command;

use Commercetools\Core\Model\Cart\ExternalLineItemTotalPrice;
use Commercetools\Core\Model\Cart\ItemShippingDetailsDraft;
use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;
use Commercetools\Core\Request\AbstractAction;
use DateTime;

/**
 * @package Commercetools\Core\Request\Me\Command
 * @link https://docs.commercetools.com/api/projects/me-carts#add-lineitem
 * @method string getAction()
 * @method MyCartAddLineItemAction setAction(string $action = null)
 * @method string getProductId()
 * @method MyCartAddLineItemAction setProductId(string $productId = null)
 * @method int getVariantId()
 * @method MyCartAddLineItemAction setVariantId(int $variantId = null)
 * @method int getQuantity()
 * @method MyCartAddLineItemAction setQuantity(int $quantity = null)
 * @method ChannelReference getSupplyChannel()
 * @method MyCartAddLineItemAction setSupplyChannel(ChannelReference $supplyChannel = null)
 * @method ChannelReference getDistributionChannel()
 * @method MyCartAddLineItemAction setDistributionChannel(ChannelReference $distributionChannel = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method MyCartAddLineItemAction setCustom(CustomFieldObjectDraft $custom = null)
 * @method ItemShippingDetailsDraft getShippingDetails()
 * @method MyCartAddLineItemAction setShippingDetails(ItemShippingDetailsDraft $shippingDetails = null)
 * @method DateTime getAddedAt()
 * @method MyCartAddLineItemAction setAddedAt(DateTime $addedAt = null)
 * @method string getSku()
 * @method MyCartAddLineItemAction setSku(string $sku = null)
 * @method ExternalTaxRateDraft getExternalTaxRate()
 * @method MyCartAddLineItemAction setExternalTaxRate(ExternalTaxRateDraft $externalTaxRate = null)
 * @method Money getExternalPrice()
 * @method MyCartAddLineItemAction setExternalPrice(Money $externalPrice = null)
 * @method ExternalLineItemTotalPrice getExternalTotalPrice()
 * @method MyCartAddLineItemAction setExternalTotalPrice(ExternalLineItemTotalPrice $externalTotalPrice = null)
 */
class MyCartAddLineItemAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'productId' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'sku' => [static::TYPE => 'string'],
            'quantity' => [static::TYPE => 'int'],
            'supplyChannel' => [static::TYPE => ChannelReference::class],
            'distributionChannel' => [static::TYPE => ChannelReference::class],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class],
            'externalTaxRate' => [static::TYPE => ExternalTaxRateDraft::class],
            'externalPrice' => [static::TYPE => Money::class],
            'externalTotalPrice' => [static::TYPE => ExternalLineItemTotalPrice::class],
            'shippingDetails' => [static::TYPE => ItemShippingDetailsDraft::class],
            'addedAt' => [static::TYPE => DateTime::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addLineItem');
    }

    /**
     * @param string $productId
     * @param int $variantId
     * @param Context|callable $context
     * @param int $quantity
     * @return MyCartAddLineItemAction
     */
    public static function ofProductIdVariantIdAndQuantity($productId, $variantId, $quantity, $context = null)
    {
        return static::of($context)->setProductId($productId)->setVariantId($variantId)->setQuantity($quantity);
    }
}
