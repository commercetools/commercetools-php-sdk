<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;
use DateTime;

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
 * @method ItemShippingDetailsDraft getShippingDetails()
 * @method LineItemDraft setShippingDetails(ItemShippingDetailsDraft $shippingDetails = null)
 * @method DateTime getAddedAt()
 * @method LineItemDraft setAddedAt(DateTime $addedAt = null)
 */
class LineItemDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'productId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'variantId' => [static::TYPE => 'int', static::OPTIONAL => true],
            'quantity' => [static::TYPE => 'int', static::OPTIONAL => true],
            'supplyChannel' => [static::TYPE => ChannelReference::class, static::OPTIONAL => true],
            'distributionChannel' => [static::TYPE => ChannelReference::class, static::OPTIONAL => true],
            'externalTaxRate' => [static::TYPE => ExternalTaxRateDraft::class, static::OPTIONAL => true],
            'externalPrice' => [static::TYPE => Money::class, static::OPTIONAL => true],
            'externalTotalPrice' => [static::TYPE => ExternalLineItemTotalPrice::class, static::OPTIONAL => true],
            'custom' => [static::TYPE => CustomFieldObject::class, static::OPTIONAL => true],
            'sku' => [static::TYPE => 'string', static::OPTIONAL => true],
            'shippingDetails' => [static::TYPE => ItemShippingDetailsDraft::class, static::OPTIONAL => true],
            'addedAt' => [static::TYPE => DateTime::class, static::OPTIONAL => true],
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
     * @param string $productId
     * @param int $variantId
     * @param int $quantity
     * @param Context|callable $context
     * @return LineItemDraft
     */
    public static function ofProductIdVariantIdAndQuantity($productId, $variantId, $quantity, $context = null)
    {
        return static::of($context)->setProductId($productId)->setVariantId($variantId)->setQuantity($quantity);
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

    /**
     * @param string $sku
     * @param int $quantity
     * @param Context|callable $context
     * @return LineItemDraft
     */
    public static function ofSkuAndQuantity($sku, $quantity, $context = null)
    {
        return static::of($context)->setSku($sku)->setQuantity($quantity);
    }
}
