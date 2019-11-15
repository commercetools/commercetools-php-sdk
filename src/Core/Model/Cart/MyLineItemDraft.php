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
 * @link https://docs.commercetools.com/http-api-projects-me-carts.html#mylineitemdraft
 * @method string getProductId()
 * @method MyLineItemDraft setProductId(string $productId = null)
 * @method int getVariantId()
 * @method MyLineItemDraft setVariantId(int $variantId = null)
 * @method int getQuantity()
 * @method MyLineItemDraft setQuantity(int $quantity = null)
 * @method ChannelReference getSupplyChannel()
 * @method MyLineItemDraft setSupplyChannel(ChannelReference $supplyChannel = null)
 * @method ChannelReference getDistributionChannel()
 * @method MyLineItemDraft setDistributionChannel(ChannelReference $distributionChannel = null)
 * @method CustomFieldObject getCustom()
 * @method MyLineItemDraft setCustom(CustomFieldObject $custom = null)
 * @method ItemShippingDetailsDraft getShippingDetails()
 * @method MyLineItemDraft setShippingDetails(ItemShippingDetailsDraft $shippingDetails = null)
 * @method string getSku()
 * @method MyLineItemDraft setSku(string $sku = null)
 */
class MyLineItemDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'productId' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'quantity' => [static::TYPE => 'int'],
            'supplyChannel' => [static::TYPE => ChannelReference::class],
            'distributionChannel' => [static::TYPE => ChannelReference::class],
            'custom' => [static::TYPE => CustomFieldObject::class],
            'sku' => [static::TYPE => 'string'],
            'shippingDetails' => [static::TYPE => ItemShippingDetailsDraft::class],
        ];
    }

    /**
     * @param string $productId
     * @param Context|callable $context
     * @return MyLineItemDraft
     */
    public static function ofProductId($productId, $context = null)
    {
        return static::of($context)->setProductId($productId);
    }

    /**
     * @param string $sku
     * @param Context|callable $context
     * @return MyLineItemDraft
     */
    public static function ofSku($sku, $context = null)
    {
        $draft = static::of($context);
        return $draft->setSku($sku);
    }
}
