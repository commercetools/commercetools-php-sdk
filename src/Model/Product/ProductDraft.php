<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:35
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Category\CategoryReference;
use Sphere\Core\Model\GeneralInfoTrait;
use Sphere\Core\Model\MetaInfoTrait;
use Sphere\Core\Model\Type\JsonObject;
use Sphere\Core\Model\Type\LocalizedString;
use Sphere\Core\Model\ProductType\ProductTypeReference;

/**
 * Class ProductDraft
 * @package Sphere\Core\Model\Product
 */
class ProductDraft extends JsonObject
{
    use GeneralInfoTrait;
    use MetaInfoTrait;

    /**
     * @var ProductTypeReference
     */
    protected $productType;

    /**
     * @var CategoryReference[]
     */
    protected $categories;

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
