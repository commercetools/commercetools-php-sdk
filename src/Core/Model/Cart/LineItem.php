<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\Price;
use Commercetools\Core\Model\Order\ItemStateCollection;
use Commercetools\Core\Model\Product\ProductVariant;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\Common\TaxedItemPrice;
use Commercetools\Core\Model\ProductType\ProductTypeReference;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://docs.commercetools.com/http-api-projects-carts.html#lineitem
 * @method string getId()
 * @method LineItem setId(string $id = null)
 * @method string getProductId()
 * @method LineItem setProductId(string $productId = null)
 * @method LocalizedString getName()
 * @method LineItem setName(LocalizedString $name = null)
 * @method ProductVariant getVariant()
 * @method LineItem setVariant(ProductVariant $variant = null)
 * @method Price getPrice()
 * @method LineItem setPrice(Price $price = null)
 * @method int getQuantity()
 * @method LineItem setQuantity(int $quantity = null)
 * @method ItemStateCollection getState()
 * @method LineItem setState(ItemStateCollection $state = null)
 * @method TaxRate getTaxRate()
 * @method LineItem setTaxRate(TaxRate $taxRate = null)
 * @method ChannelReference getSupplyChannel()
 * @method LineItem setSupplyChannel(ChannelReference $supplyChannel = null)
 * @method LocalizedString getProductSlug()
 * @method LineItem setProductSlug(LocalizedString $productSlug = null)
 * @method ChannelReference getDistributionChannel()
 * @method LineItem setDistributionChannel(ChannelReference $distributionChannel = null)
 * @method CustomFieldObject getCustom()
 * @method LineItem setCustom(CustomFieldObject $custom = null)
 * @method Money getTotalPrice()
 * @method LineItem setTotalPrice(Money $totalPrice = null)
 * @method DiscountedPricePerQuantityCollection getDiscountedPricePerQuantity()
 * @method TaxedItemPrice getTaxedPrice()
 * @method LineItem setTaxedPrice(TaxedItemPrice $taxedPrice = null)
 * @method string getPriceMode()
 * @method LineItem setPriceMode(string $priceMode = null)
 * @method ProductTypeReference getProductType()
 * @method LineItem setProductType(ProductTypeReference $productType = null)
 * @method string getLineItemMode()
 * @method LineItem setLineItemMode(string $lineItemMode = null)
 */
class LineItem extends JsonObject
{
    const PRICE_MODE_PLATFORM = 'Platform';
    const PRICE_MODE_EXTERNAL_TOTAL = 'ExternalTotal';
    const PRICE_MODE_EXTERNAL_PRICE = 'ExternalPrice';

    const LINE_ITEM_MODE_STANDARD = 'Standard';
    const LINE_ITEM_MODE_GIFT_LINE_ITEM = 'GiftLineItem';

    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'productId' => [static::TYPE => 'string'],
            'name' => [static::TYPE => LocalizedString::class],
            'productSlug' => [static::TYPE => LocalizedString::class],
            'variant' => [static::TYPE => ProductVariant::class],
            'price' => [static::TYPE => Price::class],
            'taxedPrice' => [static::TYPE => TaxedItemPrice::class],
            'quantity' => [static::TYPE => 'int'],
            'state' => [static::TYPE => ItemStateCollection::class],
            'taxRate' => [static::TYPE => TaxRate::class],
            'supplyChannel' => [static::TYPE => ChannelReference::class],
            'distributionChannel' => [static::TYPE => ChannelReference::class],
            'custom' => [static::TYPE => CustomFieldObject::class],
            'totalPrice' => [static::TYPE => Money::class],
            'discountedPricePerQuantity' => [
                static::TYPE => DiscountedPricePerQuantityCollection::class
            ],
            'priceMode' => [static::TYPE => 'string'],
            'lineItemMode' => [static::TYPE => 'string'],
            'productType' => [static::TYPE => ProductTypeReference::class],
        ];
    }

    /**
     * @param DiscountedPricePerQuantityCollection $discountedPricePerQuantity
     * @return static
     */
    public function setDiscountedPricePerQuantity(
        DiscountedPricePerQuantityCollection $discountedPricePerQuantity = null
    ) {
        return parent::setDiscountedPricePerQuantity($discountedPricePerQuantity);
    }

    /**
     * @return Money
     */
    public function getDiscountedPrice()
    {
        $centAmount = 0;
        $currencyCode = $this->getPrice()->getValue()->getCurrencyCode();
        foreach ($this->getDiscountedPricePerQuantity() as $discountedPricePerQuantity) {
            $centAmount += $discountedPricePerQuantity->getDiscountedTotal()->getCentAmount();
        }
        $this->getDiscountedPricePerQuantity()->rewind();
        return Money::ofCurrencyAndAmount($currencyCode, $centAmount);
    }
}
