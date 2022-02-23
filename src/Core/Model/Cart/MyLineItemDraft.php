<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use DateTime;

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
 * @method DateTime getAddedAt()
 * @method MyLineItemDraft setAddedAt(DateTime $addedAt = null)
 */
class MyLineItemDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'productId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'variantId' => [static::TYPE => 'int', static::OPTIONAL => true],
            'quantity' => [static::TYPE => 'int'],
            'supplyChannel' => [static::TYPE => ChannelReference::class, static::OPTIONAL => true],
            'distributionChannel' => [static::TYPE => ChannelReference::class, static::OPTIONAL => true],
            'custom' => [static::TYPE => CustomFieldObject::class, static::OPTIONAL => true],
            'shippingDetails' => [static::TYPE => ItemShippingDetailsDraft::class, static::OPTIONAL => true],
            'sku' => [static::TYPE => 'string', static::OPTIONAL => true],
            'addedAt' => [static::TYPE => DateTime::class, static::OPTIONAL => true],
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
        return static::of($context)->setSku($sku);
    }

    /**
     * @param string $productId
     * @param int $variantId
     * @param int $quantity
     * @param Context|callable $context
     * @return MyLineItemDraft
     */
    public static function ofProductIdVariantIdAndQuantity($productId, $variantId, $quantity, $context = null)
    {
        return static::of($context)->setProductId($productId)->setVariantId($variantId)->setQuantity($quantity);
    }
}
