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
            'productId' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'quantity' => [static::TYPE => 'int'],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class],
            'addedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'sku' => [static::TYPE => 'string'],
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
}
