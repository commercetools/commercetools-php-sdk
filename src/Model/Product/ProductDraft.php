<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:35
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Category\CategoryReference;
use Sphere\Core\Model\Type\JsonObject;
use Sphere\Core\Model\Type\LocalizedString;
use Sphere\Core\Model\ProductType\ProductTypeReference;

/**
 * Class ProductDraft
 * @package Sphere\Core\Model\Product
 */
class ProductDraft extends JsonObject
{
    /**
     * @var LocalizedString
     */
    protected $name;

    /**
     * @var ProductTypeReference
     */
    protected $productType;

    /**
     * @var LocalizedString
     */
    protected $slug;

    /**
     * @var LocalizedString
     */
    protected $description;

    /**
     * @var CategoryReference[]
     */
    protected $categories;

    /**
     * @var LocalizedString
     */
    protected $metaTitle;

    /**
     * @var LocalizedString
     */
    protected $metaDescription;

    /**
     * @var LocalizedString
     */
    protected $metaKeywords;

    /**
     * @var ProductVariantDraft
     */
    protected $masterVariant;

    /**
     * @var ProductVariantDraft[]
     */
    protected $variants;

    public function __construct(LocalizedString $name, ProductTypeReference $productType, LocalizedString $slug)
    {
        $this->setName($name);
        $this->setProductType($productType);
        $this->setSlug($slug);
    }

    /**
     * @return LocalizedString
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param LocalizedString $name
     * @return $this
     */
    public function setName(LocalizedString $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return ProductTypeReference
     */
    public function getProductType()
    {
        return $this->productType;
    }

    /**
     * @param ProductTypeReference $productType
     * @return $this
     */
    public function setProductType(ProductTypeReference $productType)
    {
        $this->productType = $productType;

        return $this;
    }

    /**
     * @return LocalizedString
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param LocalizedString $slug
     * @return $this
     */
    public function setSlug(LocalizedString $slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return LocalizedString
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param LocalizedString $description
     * @return $this
     */
    public function setDescription(LocalizedString $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return CategoryReference[]
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param CategoryReference[] $categories
     * @return $this
     */
    public function setCategories(array $categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return LocalizedString
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * @param LocalizedString $metaTitle
     * @return $this
     */
    public function setMetaTitle(LocalizedString $metaTitle)
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    /**
     * @return LocalizedString
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @param LocalizedString $metaDescription
     * @return $this
     */
    public function setMetaDescription(LocalizedString $metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * @return LocalizedString
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * @param LocalizedString $metaKeywords
     * @return $this
     */
    public function setMetaKeywords(LocalizedString $metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * @return ProductVariantDraft
     */
    public function getMasterVariant()
    {
        return $this->masterVariant;
    }

    /**
     * @param ProductVariantDraft $masterVariant
     * @return $this
     */
    public function setMasterVariant(ProductVariantDraft $masterVariant)
    {
        $this->masterVariant = $masterVariant;

        return $this;
    }

    /**
     * @return ProductVariantDraft[]
     */
    public function getVariants()
    {
        return $this->variants;
    }

    /**
     * @param ProductVariantDraft[] $variants
     * @return $this
     */
    public function setVariants(array $variants)
    {
        $this->variants = $variants;

        return $this;
    }
}
