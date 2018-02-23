<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\Price;
use Commercetools\Core\Model\Order\ItemState;
use Commercetools\Core\Model\Order\ItemStateCollection;
use Commercetools\Core\Model\Product\ProductVariant;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://docs.commercetools.com/http-api-projects-carts.html#lineitemdraft
 * @method string getProductId()
 * @method LineItemDraft setProductId(string $productId = null)
 * @method int getVariantId()
 * @method LineItemDraft setVariantId(int $variantId = null)
 * @method int getQuantity()
 * @method LineItemDraft setQuantity(int $quantity = null)
 * @method ChannelReference getSupplyChannel()
 * @method LineItemDraft setSupplyChannel(ChannelReference $supplyChannel = null)
 * @method ChannelReference getDistributionChannel()
 * @method LineItemDraft setDistributionChannel(ChannelReference $distributionChannel = null)
 * @method CustomFieldObject getCustom()
 * @method LineItemDraft setCustom(CustomFieldObject $custom = null)
 * @method ExternalTaxRateDraft getExternalTaxRate()
 * @method LineItemDraft setExternalTaxRate(ExternalTaxRateDraft $externalTaxRate = null)
 * @method Money getExternalPrice()
 * @method LineItemDraft setExternalPrice(Money $externalPrice = null)
 * @method ExternalLineItemTotalPrice getExternalTotalPrice()
 * @method LineItemDraft setExternalTotalPrice(ExternalLineItemTotalPrice $externalTotalPrice = null)
 * @method string getSku()
 * @method LineItemDraft setSku(string $sku = null)
 */
class LineItemDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'productId' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'quantity' => [static::TYPE => 'int'],
            'supplyChannel' => [static::TYPE => ChannelReference::class],
            'distributionChannel' => [static::TYPE => ChannelReference::class],
            'externalTaxRate' => [static::TYPE => ExternalTaxRateDraft::class],
            'externalPrice' => [static::TYPE => Money::class],
            'externalTotalPrice' => [static::TYPE => ExternalLineItemTotalPrice::class],
            'custom' => [static::TYPE => CustomFieldObject::class],
            'sku' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param string $productId
     * @param Context|callable $context
     * @return LineItemDraft
     */
    public static function ofProductId($productId, $context = null)
    {
        $draft = static::of($context);
        return $draft->setProductId($productId);
    }

    /**
     * @param string $sku
     * @param Context|callable $context
     * @return LineItemDraft
     */
    public static function ofSku($sku, $context = null)
    {
        $draft = static::of($context);
        return $draft->setSku($sku);
    }
}
