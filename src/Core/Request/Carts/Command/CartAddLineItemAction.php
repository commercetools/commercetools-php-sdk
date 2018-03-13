<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Cart\ExternalLineItemTotalPrice;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://docs.commercetools.com/http-api-projects-carts.html#add-lineitem
 * @method string getAction()
 * @method CartAddLineItemAction setAction(string $action = null)
 * @method string getProductId()
 * @method CartAddLineItemAction setProductId(string $productId = null)
 * @method int getVariantId()
 * @method CartAddLineItemAction setVariantId(int $variantId = null)
 * @method int getQuantity()
 * @method CartAddLineItemAction setQuantity(int $quantity = null)
 * @method ChannelReference getSupplyChannel()
 * @method CartAddLineItemAction setSupplyChannel(ChannelReference $supplyChannel = null)
 * @method ChannelReference getDistributionChannel()
 * @method CartAddLineItemAction setDistributionChannel(ChannelReference $distributionChannel = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method CartAddLineItemAction setCustom(CustomFieldObjectDraft $custom = null)
 * @method ExternalTaxRateDraft getExternalTaxRate()
 * @method CartAddLineItemAction setExternalTaxRate(ExternalTaxRateDraft $externalTaxRate = null)
 * @method Money getExternalPrice()
 * @method CartAddLineItemAction setExternalPrice(Money $externalPrice = null)
 * @method ExternalLineItemTotalPrice getExternalTotalPrice()
 * @method CartAddLineItemAction setExternalTotalPrice(ExternalLineItemTotalPrice $externalTotalPrice = null)
 * @method string getSku()
 * @method CartAddLineItemAction setSku(string $sku = null)
 */
class CartAddLineItemAction extends AbstractAction
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
        ];
    }

    /**
     * @param string $productId
     * @param int $variantId
     * @param Context|callable $context
     * @param int $quantity
     * @return CartAddLineItemAction
     */
    public static function ofProductIdVariantIdAndQuantity($productId, $variantId, $quantity, $context = null)
    {
        return static::of($context)->setProductId($productId)->setVariantId($variantId)->setQuantity($quantity);
    }

    /**
     * @param string $sku
     * @param Context|callable $context
     * @param int $quantity
     * @return CartAddLineItemAction
     */
    public static function ofSkuAndQuantity($sku, $quantity, $context = null)
    {
        return static::of($context)->setSku($sku)->setQuantity($quantity);
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
}
