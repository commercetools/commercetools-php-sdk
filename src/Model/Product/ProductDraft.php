<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:35
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Category\CategoryReference;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\OfTrait;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\LocalizedString;
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
            'name' => [self::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'slug' => [self::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'description' => [self::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'productType' => [self::TYPE => '\Sphere\Core\Model\ProductType\ProductTypeReference'],
            'categories' => [self::TYPE => '\Sphere\Core\Model\Common\Collection'],
            'masterVariant' => [self::TYPE => '\Sphere\Core\Model\Product\ProductVariantDraft'],
            'variants' => [self::TYPE => '\Sphere\Core\Model\Common\Collection'],
            'metaTitle' => [self::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'metaDescription' => [self::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'metaKeywords' => [self::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
        ];
    }

    public function __construct(
        ProductTypeReference $productType,
        LocalizedString $name,
        LocalizedString $slug,
        Context $context = null
    ) {
        $this->setContext($context);
        $this->setName($name);
        $this->setProductType($productType);
        $this->setSlug($slug);
    }

    /**
     * @param array $data
     * @param Context $context
     * @return static
     */
    public static function fromArray(array $data, Context $context = null)
    {
        $draft = new static(
            ProductTypeReference::fromArray($data['reference'], $context),
            LocalizedString::fromArray($data['name'], $context),
            LocalizedString::fromArray($data['slug'], $context),
            $context
        );
        $draft->setRawData($data);

        return $draft;
    }
}
