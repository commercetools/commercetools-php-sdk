<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShoppingList;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Model\ShoppingList
 *
 * @method string getProductId()
 * @method LineItemDraft setProductId(string $productId = null)
 * @method int getVariantId()
 * @method LineItemDraft setVariantId(int $variantId = null)
 * @method int getQuantity()
 * @method LineItemDraft setQuantity(int $quantity = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method LineItemDraft setCustom(CustomFieldObjectDraft $custom = null)
 * @method DateTimeDecorator getAddedAt()
 * @method LineItemDraft setAddedAt(DateTime $addedAt = null)
 * @method string getSku()
 * @method LineItemDraft setSku(string $sku = null)
 */
class LineItemDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'productId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'variantId' => [static::TYPE => 'int', static::OPTIONAL => true],
            'quantity' => [static::TYPE => 'int', static::OPTIONAL => true],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class, static::OPTIONAL => true],
            'addedAt' => [
                static::TYPE => DateTime::class,
                static::OPTIONAL => true,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'sku' => [static::TYPE => 'string', static::OPTIONAL => true],
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

    /**
     * @param string $productId
     * @param int $variantId
     * @param int $quantity
     * @param Context|callable $context
     * @return LineItemDraft
     */
    public static function ofProductIdVariantIdAndQuantity($productId, $variantId, $quantity, $context = null)
    {
        return static::of($context)
            ->setProductId($productId)
            ->setVariantId($variantId)
            ->setQuantity($quantity);
    }
}
