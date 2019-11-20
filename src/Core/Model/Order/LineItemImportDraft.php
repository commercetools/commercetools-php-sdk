<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Cart\ItemShippingDetailsDraft;
use Commercetools\Core\Model\Common\AddressCollection;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Price;
use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://docs.commercetools.com/http-api-projects-orders-import.html#lineitemimportdraft
 * @method string getProductId()
 * @method LineItemImportDraft setProductId(string $productId = null)
 * @method LocalizedString getName()
 * @method LineItemImportDraft setName(LocalizedString $name = null)
 * @method ProductVariantImportDraft getVariant()
 * @method LineItemImportDraft setVariant(ProductVariantImportDraft $variant = null)
 * @method Price getPrice()
 * @method LineItemImportDraft setPrice(Price $price = null)
 * @method int getQuantity()
 * @method LineItemImportDraft setQuantity(int $quantity = null)
 * @method ItemStateCollection getState()
 * @method LineItemImportDraft setState(ItemStateCollection $state = null)
 * @method ChannelReference getSupplyChannel()
 * @method LineItemImportDraft setSupplyChannel(ChannelReference $supplyChannel = null)
 * @method TaxRate getTaxRate()
 * @method LineItemImportDraft setTaxRate(TaxRate $taxRate = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method LineItemImportDraft setCustom(CustomFieldObjectDraft $custom = null)
 * @method AddressCollection getItemShippingAddresses()
 * @method LineItemImportDraft setItemShippingAddresses(AddressCollection $itemShippingAddresses = null)
 * @method ItemShippingDetailsDraft getShippingDetails()
 * @method LineItemImportDraft setShippingDetails(ItemShippingDetailsDraft $shippingDetails = null)
 * @method ChannelReference getDistributionChannel()
 * @method LineItemImportDraft setDistributionChannel(ChannelReference $distributionChannel = null)
 */
class LineItemImportDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'productId' => [static::TYPE => 'string'],
            'name' => [static::TYPE => LocalizedString::class],
            'variant' => [static::TYPE => ProductVariantImportDraft::class],
            'price' => [static::TYPE => Price::class],
            'quantity' => [static::TYPE => 'int'],
            'state' => [static::TYPE => ItemStateCollection::class],
            'supplyChannel' => [static::TYPE => ChannelReference::class],
            'distributionChannel' => [static::TYPE => ChannelReference::class],
            'taxRate' => [static::TYPE => TaxRate::class],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class],
            'shippingDetails' => [static::TYPE => ItemShippingDetailsDraft::class],
        ];
    }

    /**
     * @param LocalizedString $name
     * @param Price $price
     * @param int $quantity
     * @param Context|callable $context
     * @return LineItemImportDraft
     */
    public static function ofNamePriceAndQuantity(LocalizedString $name, Price $price, $quantity, $context = null)
    {
        return static::of($context)->setName($name)->setPrice($price)->setQuantity($quantity);
    }

    /**
     * @param LocalizedString $name
     * @param Price $price
     * @param ProductVariantImportDraft $variant
     * @param int $quantity
     * @param Context|callable $context
     * @return LineItemImportDraft
     */
    public static function ofNamePriceVariantAndQuantity(
        LocalizedString $name,
        Price $price,
        ProductVariantImportDraft $variant,
        $quantity,
        $context = null
    ) {
        return static::of($context)
            ->setName($name)
            ->setPrice($price)
            ->setVariant($variant)
            ->setQuantity($quantity);
    }
}
