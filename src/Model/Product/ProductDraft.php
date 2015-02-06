<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:35
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Category\CategoryReference;
use Sphere\Core\Model\OfTrait;
use Sphere\Core\Model\Type\JsonObject;
use Sphere\Core\Model\Type\LocalizedString;
use Sphere\Core\Model\ProductType\ProductTypeReference;

/**
 * Class ProductDraft
 * @package Sphere\Core\Model\Product
 * @method LocalizedString getName()
 * @method LocalizedString getSlug()
 * @method LocalizedString getDescription()
 * @method ProductTypeReference getProductType()
 * @method CategoryReference[] getCategories()
 * @method ProductVariantDraft getMasterVariant()
 * @method ProductVariantDraft[] getVariants()
 * @method LocalizedString getMetaTitle()
 * @method LocalizedString getMetaDescription()
 * @method LocalizedString getMetaKeywords()
 * @method ProductDraft setName(LocalizedString $name)
 * @method ProductDraft setSlug(LocalizedString $slug)
 * @method ProductDraft setDescription(LocalizedString $description)
 * @method ProductDraft setProductType(ProductTypeReference $productType)
 * @method ProductDraft setCategories(array $categories)
 * @method ProductDraft setMasterVariant(ProductVariantDraft $masterVariant)
 * @method ProductDraft setVariants(array $variants)
 * @method ProductDraft setMetaTitle(LocalizedString $metaTitle)
 * @method ProductDraft setMetaDescription(LocalizedString $metaDescription)
 * @method ProductDraft setMetaKeywords(LocalizedString $metaKeywords)
 */
class ProductDraft extends JsonObject
{
    use OfTrait;

    public function getFields()
    {
        return [
            'name' => [self::TYPE => '\Sphere\Core\Model\Type\LocalizedString'],
            'slug' => [self::TYPE => '\Sphere\Core\Model\Type\LocalizedString'],
            'description' => [self::TYPE => '\Sphere\Core\Model\Type\LocalizedString'],
            'productType' => [self::TYPE => '\Sphere\Core\Model\ProductType\ProductTypeReference'],
            'categories' => [self::TYPE => 'array'],
            'masterVariant' => [self::TYPE => '\Sphere\Core\Model\Product\ProductVariantDraft'],
            'variants' => [self::TYPE => 'array'],
            'metaTitle' => [self::TYPE => '\Sphere\Core\Model\Type\LocalizedString'],
            'metaDescription' => [self::TYPE => '\Sphere\Core\Model\Type\LocalizedString'],
            'metaKeywords' => [self::TYPE => '\Sphere\Core\Model\Type\LocalizedString'],
        ];
    }

    public function __construct(ProductTypeReference $productType, LocalizedString $name, LocalizedString $slug)
    {
        $this->setName($name);
        $this->setProductType($productType);
        $this->setSlug($slug);
    }
}
