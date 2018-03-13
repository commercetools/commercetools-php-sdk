<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShoppingList;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\ProductType\ProductTypeReference;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Product\ProductVariant;
use DateTime;

/**
 * @package Commercetools\Core\Model\ShoppingList
 *
 * @method string getId()
 * @method LineItem setId(string $id = null)
 * @method string getProductId()
 * @method LineItem setProductId(string $productId = null)
 * @method int getVariantId()
 * @method LineItem setVariantId(int $variantId = null)
 * @method ProductTypeReference getProductType()
 * @method LineItem setProductType(ProductTypeReference $productType = null)
 * @method int getQuantity()
 * @method LineItem setQuantity(int $quantity = null)
 * @method CustomFieldObject getCustom()
 * @method LineItem setCustom(CustomFieldObject $custom = null)
 * @method DateTimeDecorator getAddedAt()
 * @method LineItem setAddedAt(DateTime $addedAt = null)
 * @method LocalizedString getName()
 * @method LineItem setName(LocalizedString $name = null)
 * @method DateTimeDecorator getDeactivatedAt()
 * @method LineItem setDeactivatedAt(DateTime $deactivatedAt = null)
 * @method LocalizedString getProductSlug()
 * @method LineItem setProductSlug(LocalizedString $productSlug = null)
 * @method ProductVariant getVariant()
 * @method LineItem setVariant(ProductVariant $variant = null)
 */
class LineItem extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'productId' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'productType' => [static::TYPE => ProductTypeReference::class],
            'quantity' => [static::TYPE => 'int'],
            'custom' => [static::TYPE => CustomFieldObject::class],
            'addedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'name' => [static::TYPE => LocalizedString::class],
            'deactivatedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'productSlug' => [static::TYPE => LocalizedString::class],
            'variant' => [static::TYPE => ProductVariant::class],
        ];
    }
}
