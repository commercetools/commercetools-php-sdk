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
use Commercetools\Core\Model\Order\ItemState;
use Commercetools\Core\Model\Order\ItemStateCollection;
use Commercetools\Core\Model\Product\ProductVariant;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://dev.commercetools.com/http-api-projects-carts.html#lineitemdraft
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
 */
class LineItemDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'productId' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'quantity' => [static::TYPE => 'int'],
            'supplyChannel' => [static::TYPE => '\Commercetools\Core\Model\Channel\ChannelReference'],
            'distributionChannel' => [static::TYPE => '\Commercetools\Core\Model\Channel\ChannelReference'],
            'externalTaxRate' => [static::TYPE => '\Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft'],
            'custom' => [static::TYPE => '\Commercetools\Core\Model\CustomField\CustomFieldObject'],
        ];
    }
}
