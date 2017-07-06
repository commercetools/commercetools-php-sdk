<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CartDiscount;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Product\ProductReference;

/**
 * @package Commercetools\Core\Model\CartDiscount
 *
 * @method string getType()
 * @method GiftLineItemCartDiscountValue setType(string $type = null)
 * @method ProductReference getProduct()
 * @method GiftLineItemCartDiscountValue setProduct(ProductReference $product = null)
 * @method int getVariantId()
 * @method GiftLineItemCartDiscountValue setVariantId(int $variantId = null)
 * @method ChannelReference getSupplyChannel()
 * @method GiftLineItemCartDiscountValue setSupplyChannel(ChannelReference $supplyChannel = null)
 * @method ChannelReference getDistributionChannel()
 * @method GiftLineItemCartDiscountValue setDistributionChannel(ChannelReference $distributionChannel = null)
 */
class GiftLineItemCartDiscountValue extends CartDiscountValue
{
    /**
     * @inheritDoc
     */
    public function __construct(array $data = [], $context = null)
    {
        $data['type'] = static::TYPE_GIFT_LINE_ITEM;

        parent::__construct($data, $context);
    }

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'product' => [static::TYPE => ProductReference::class],
            'variantId' => [static::TYPE => 'int'],
            'supplyChannel' => [static::TYPE => ChannelReference::class],
            'distributionChannel' => [static::TYPE => ChannelReference::class],
        ];
    }

    /**
     * @param ProductReference $product
     * @param int $variantId
     * @param Context|callable $context
     * @return GiftLineItemCartDiscountValue
     */
    public static function ofProductAndVariantId(ProductReference $product, $variantId, $context = null)
    {
        return static::of($context)->setProduct($product)->setVariantId($variantId);
    }
}
