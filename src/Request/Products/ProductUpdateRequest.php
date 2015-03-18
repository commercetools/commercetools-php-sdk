<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 05.02.15, 17:26
 */

namespace Sphere\Core\Request\Products;

use Sphere\Core\Model\Category\CategoryReference;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Image;
use Sphere\Core\Model\Product\LocalizedSearchKeywords;
use Sphere\Core\Model\Product\ProductVariantDraft;
use Sphere\Core\Model\TaxCategory\TaxCategoryReference;
use Sphere\Core\Model\Common\Attribute;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Model\Common\Price;
use Sphere\Core\Request\AbstractUpdateRequest;
use Sphere\Core\Request\Products\Command\ProductAddExternalImageAction;
use Sphere\Core\Request\Products\Command\ProductAddPriceAction;
use Sphere\Core\Request\Products\Command\ProductAddToCategoryAction;
use Sphere\Core\Request\Products\Command\ProductAddVariantAction;
use Sphere\Core\Request\Products\Command\ProductChangeNameAction;
use Sphere\Core\Request\Products\Command\ProductChangePriceAction;
use Sphere\Core\Request\Products\Command\ProductChangeSlugAction;
use Sphere\Core\Request\Products\Command\ProductPublishAction;
use Sphere\Core\Request\Products\Command\ProductRemoveFromCategoryAction;
use Sphere\Core\Request\Products\Command\ProductRemoveImageAction;
use Sphere\Core\Request\Products\Command\ProductRemovePriceAction;
use Sphere\Core\Request\Products\Command\ProductRemoveVariantAction;
use Sphere\Core\Request\Products\Command\ProductRevertStagedChangesAction;
use Sphere\Core\Request\Products\Command\ProductSetAttributeAction;
use Sphere\Core\Request\Products\Command\ProductSetAttributeInAllVariantsAction;
use Sphere\Core\Request\Products\Command\ProductSetDescriptionAction;
use Sphere\Core\Request\Products\Command\ProductSetMetaAttributesAction;
use Sphere\Core\Request\Products\Command\ProductSetSearchKeywordsAction;
use Sphere\Core\Request\Products\Command\ProductSetSKUAction;
use Sphere\Core\Request\Products\Command\ProductSetTaxCategoryAction;
use Sphere\Core\Request\Products\Command\ProductUnpublishAction;

/**
 * Class ProductUpdateRequest
 * @package Sphere\Core\Request\Products
 */
class ProductUpdateRequest extends AbstractUpdateRequest
{
    const NAME = 'name';
    const SLUG = 'slug';
    const DESCRIPTION = 'description';
    const SKU = 'sku';
    const PRICES = 'prices';
    const ATTRIBUTES = 'attributes';
    const STAGED = 'staged';
    const ID = 'id';
    const META_TITLE = 'metaTitle';
    const META_DESCRIPTION = 'metaDescription';
    const META_KEYWORDS = 'metaKeywords';
    const VARIANT_ID = 'variantId';
    const PRICE = 'price';
    const VALUE = 'value';
    const CATEGORY = 'category';
    const TAX_CATEGORY = 'taxCategory';
    const IMAGE = 'image';
    const IMAGE_URL = 'imageUrl';
    const SEARCH_KEYWORDS = 'searchKeywords';

    const CHANGE_NAME = 'changeName';
    const CHANGE_SLUG = 'changeSlug';
    const SET_DESCRIPTION = 'setDescription';
    const ADD_VARIANT = 'addVariant';
    const REMOVE_VARIANT = 'removeVariant';
    const SET_META_ATTRIBUTES = 'setMetaAttributes';
    const ADD_PRICE = 'addPrice';
    const CHANGE_PRICE = 'changePrice';
    const REMOVE_PRICE = 'removePrice';
    const SET_ATTRIBUTE = 'setAttribute';
    const SET_ATTRIBUTE_IN_ALL_VARIANTS = 'setAttributeInAllVariants';
    const ADD_TO_CATEGORY = 'addToCategory';
    const REMOVE_FROM_CATEGORY = 'removeFromCategory';
    const SET_TAX_CATEGORY = 'setTaxCategory';
    const SET_SKU = 'setSKU';
    const ADD_EXTERNAL_IMAGE = 'addExternalImage';
    const REMOVE_IMAGE = 'removeImage';
    const SET_SEARCH_KEYWORDS = 'setSearchKeywords';
    const REVERT_STAGED_CHANGES = 'revertStagedChanges';
    const PUBLISH = 'publish';
    const UNPUBLISH = 'unpublish';

    protected $resultClass = '\Sphere\Core\Model\Product\Product';

    /**
     * @param string $id
     * @param int $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($id, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(ProductsEndpoint::endpoint(), $id, $version, $actions, $context);
    }

    /**
     * @param LocalizedString $name
     * @return $this
     * @deprecated will be removed with Milestone 2
     */
    public function changeName(LocalizedString $name)
    {
        return $this->addAction(new ProductChangeNameAction($name));
    }

    /**
     * @param LocalizedString $slug
     * @param bool $staged
     * @return $this
     * @deprecated will be removed with Milestone 2
     */
    public function changeSlug(LocalizedString $slug, $staged = true)
    {
        $action = new ProductChangeSlugAction($slug);
        $action->setStaged($staged);
        return $this->addAction($action);
    }

    /**
     * @param LocalizedString $description
     * @param bool $staged
     * @return $this
     * @deprecated will be removed with Milestone 2
     */
    public function setDescription(LocalizedString $description, $staged = true)
    {
        $action = new ProductSetDescriptionAction($description);
        $action->setStaged($staged);
        return $this->addAction($action);
    }

    /**
     * @param ProductVariantDraft $variant
     * @param bool $staged
     * @return $this
     * @deprecated will be removed with Milestone 2
     */
    public function addVariant(ProductVariantDraft $variant = null, $staged = true)
    {
        $action = new ProductAddVariantAction();
        $action->setStaged($staged);
        if (!is_null($variant)) {
            $action->setPrices($variant->getPrices())
                ->setSku($variant->getSku())
                ->setAttributes($variant->getAttributes());
        }
        return $this->addAction($action);
    }

    /**
     * @param $variantId
     * @param bool $staged
     * @return $this
     * @deprecated will be removed with Milestone 2
     */
    public function removeVariant($variantId, $staged = true)
    {
        $action = new ProductRemoveVariantAction($variantId);
        $action->setStaged($staged);
        return $this->addAction($action);
    }

    /**
     * @param LocalizedString $metaTitle
     * @param LocalizedString $metaDescription
     * @param LocalizedString $metaKeywords
     * @param bool $staged
     * @return $this
     * @deprecated will be removed with Milestone 2
     */
    public function setMetaAttributes(
        LocalizedString $metaTitle = null,
        LocalizedString $metaDescription = null,
        LocalizedString $metaKeywords = null,
        $staged = true
    ) {
        $action = new ProductSetMetaAttributesAction();
        $action->setMetaDescription($metaDescription)
            ->setMetaKeywords($metaKeywords)
            ->setMetaTitle($metaTitle)
            ->setStaged($staged);

        return $this->addAction($action);
    }

    /**
     * @param $variantId
     * @param Price $price
     * @param bool $staged
     * @return $this
     * @deprecated will be removed with Milestone 2
     */
    public function addPrice($variantId, Price $price, $staged = true)
    {
        $action = new ProductAddPriceAction($variantId, $price);
        $action->setStaged($staged);

        return $this->addAction($action);
    }

    /**
     * @param $variantId
     * @param Price $price
     * @param bool $staged
     * @return $this
     * @deprecated will be removed with Milestone 2
     */
    public function changePrice($variantId, Price $price, $staged = true)
    {
        $action = new ProductChangePriceAction($variantId, $price);
        $action->setStaged($staged);

        return $this->addAction($action);
    }

    /**
     * @param $variantId
     * @param Price $price
     * @param bool $staged
     * @return $this
     * @deprecated will be removed with Milestone 2
     */
    public function removePrice($variantId, Price $price, $staged = true)
    {
        $action = new ProductRemovePriceAction($variantId, $price);
        $action->setStaged($staged);

        return $this->addAction($action);
    }

    /**
     * @param $variantId
     * @param Attribute $attribute
     * @param bool $staged
     * @return $this
     * @deprecated will be removed with Milestone 2
     */
    public function setAttribute($variantId, Attribute $attribute, $staged = true)
    {
        $action = new ProductSetAttributeAction($variantId, $attribute->getName());
        $action->setValue($attribute->getValue())
            ->setStaged($staged);
        return $this->addAction($action);
    }

    /**
     * @param Attribute $attribute
     * @param bool $staged
     * @return $this
     * @deprecated will be removed with Milestone 2
     */
    public function setAttributeInAllVariants(Attribute $attribute, $staged = true)
    {
        $action = new ProductSetAttributeInAllVariantsAction($attribute->getName());
        $action->setValue($attribute->getValue())
            ->setStaged($staged);
        return $this->addAction($action);
    }

    /**
     * @param CategoryReference $category
     * @param bool $staged
     * @return $this
     * @deprecated will be removed with Milestone 2
     */
    public function addToCategory(CategoryReference $category, $staged = true)
    {
        $action = new ProductAddToCategoryAction($category);
        $action->setStaged($staged);
        return $this->addAction($action);
    }

    /**
     * @param CategoryReference $category
     * @param bool $staged
     * @return $this
     * @deprecated will be removed with Milestone 2
     */
    public function removeFromCategory(CategoryReference $category, $staged = true)
    {
        $action = new ProductRemoveFromCategoryAction($category);
        $action->setStaged($staged);
        return $this->addAction($action);
    }

    /**
     * @param TaxCategoryReference $taxCategory
     * @param bool $staged
     * @return $this
     * @deprecated will be removed with Milestone 2
     */
    public function setTaxCategory(TaxCategoryReference $taxCategory, $staged = true)
    {
        $action = new ProductSetTaxCategoryAction($taxCategory);
        $action->setStaged($staged);
        return $this->addAction($action);
    }

    /**
     * @param $variantId
     * @param null $sku
     * @return $this
     * @deprecated will be removed with Milestone 2
     */
    public function setSKU($variantId, $sku = null)
    {
        $action = new ProductSetSKUAction($variantId);
        $action->setSKU($sku);
        return $this->addAction($action);
    }

    /**
     * @param $variantId
     * @param Image $image
     * @param bool $staged
     * @return $this
     * @deprecated will be removed with Milestone 2
     */
    public function addExternalImage($variantId, Image $image, $staged = true)
    {
        $action = new ProductAddExternalImageAction($variantId, $image);
        $action->setStaged($staged);
        return $this->addAction($action);
    }

    /**
     * @param $variantId
     * @param string $imageUrl
     * @param bool $staged
     * @return $this
     * @deprecated will be removed with Milestone 2
     */
    public function removeImage($variantId, $imageUrl, $staged = true)
    {
        $action = new ProductRemoveImageAction($variantId, $imageUrl);
        $action->setStaged($staged);
        return $this->addAction($action);
    }

    /**
     * @param $searchKeywords
     * @param bool $staged
     * @return $this
     * @deprecated will be removed with Milestone 2
     */
    public function setSearchKeywords($searchKeywords, $staged = true)
    {
        if (!$searchKeywords instanceof LocalizedSearchKeywords) {
            $searchKeywords = new LocalizedSearchKeywords($searchKeywords);
        }
        $action = new ProductSetSearchKeywordsAction($searchKeywords);
        $action->setStaged($staged);
        return $this->addAction($action);
    }

    /**
     * @return $this
     * @deprecated will be removed with Milestone 2
     */
    public function revertStagedChanges()
    {
        return $this->addAction(new ProductRevertStagedChangesAction());
    }

    /**
     * @return $this
     * @deprecated will be removed with Milestone 2
     */
    public function publish()
    {
        return $this->addAction(new ProductPublishAction());
    }

    /**
     * @return $this
     * @deprecated will be removed with Milestone 2
     */
    public function unpublish()
    {
        return $this->addAction(new ProductUnpublishAction());
    }
}
