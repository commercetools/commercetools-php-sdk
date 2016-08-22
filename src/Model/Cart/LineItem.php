<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
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

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://dev.commercetools.com/http-api-projects-carts.html#lineitem
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
 */
class LineItem extends JsonObject
{
    const PRICE_MODE_PLATFORM = 'Platform';
    const PRICE_MODE_EXTERNAL_TOTAL = 'ExternalTotal';

    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'productId' => [static::TYPE => 'string'],
            'name' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'productSlug' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'variant' => [static::TYPE => '\Commercetools\Core\Model\Product\ProductVariant'],
            'price' => [static::TYPE => '\Commercetools\Core\Model\Common\Price'],
            'taxedPrice' => [static::TYPE => '\Commercetools\Core\Model\Common\TaxedItemPrice'],
            'quantity' => [static::TYPE => 'int'],
            'state' => [static::TYPE => '\Commercetools\Core\Model\Order\ItemStateCollection'],
            'taxRate' => [static::TYPE => '\Commercetools\Core\Model\TaxCategory\TaxRate'],
            'supplyChannel' => [static::TYPE => '\Commercetools\Core\Model\Channel\ChannelReference'],
            'distributionChannel' => [static::TYPE => '\Commercetools\Core\Model\Channel\ChannelReference'],
            'custom' => [static::TYPE => '\Commercetools\Core\Model\CustomField\CustomFieldObject'],
            'totalPrice' => [static::TYPE => '\Commercetools\Core\Model\Common\Money'],
            'discountedPricePerQuantity' => [
                static::TYPE => '\Commercetools\Core\Model\Cart\DiscountedPricePerQuantityCollection'
            ],
            'priceMode' => [static::TYPE => 'string']
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
        return Money::ofCurrencyAndAmount($currencyCode, $centAmount);
    }
}
