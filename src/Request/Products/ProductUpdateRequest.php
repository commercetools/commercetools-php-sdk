<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 05.02.15, 17:26
 */

namespace Sphere\Core\Request\Products;

use Sphere\Core\Model\Category\CategoryReference;
use Sphere\Core\Model\Product\ProductVariantDraft;
use Sphere\Core\Model\TaxCategory\TaxCategoryReference;
use Sphere\Core\Model\Common\Attribute;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Model\Common\Price;
use Sphere\Core\Request\AbstractUpdateRequest;
use Sphere\Core\Request\Products\ProductsEndpoint;

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

    /**
     * @param string $id
     * @param int $version
     * @param array $actions
     */
    public function __construct($id, $version, array $actions = [])
    {
        parent::__construct(ProductsEndpoint::endpoint(), $id, $version, $actions);
    }

    public function changeName(LocalizedString $name)
    {
        $this->addAction(
            [
                static::ACTION => static::CHANGE_NAME,
                static::NAME => $name
            ]
        );


    }

    public function addAction(array $action, $staged = true)
    {
        if ($staged) {
            $action[static::STAGED] = true;
        }
        return parent::addAction($action);
    }

    protected function addValue($action, $field, $value = null)
    {
        if (!is_null($value)) {
            $action[$field] = $value;
        }

        return $action;
    }

    public function changeSlug(LocalizedString $slug, $staged = true)
    {
        return $this->addAction(
            [
                static::ACTION => static::CHANGE_SLUG,
                static::SLUG => $slug,
            ],
            $staged
        );


    }

    public function setDescription(LocalizedString $description, $staged = true)
    {
        return $this->addAction(
            [
                static::ACTION => static::SET_DESCRIPTION,
                static::DESCRIPTION => $description
            ],
            $staged
        );


    }

    public function addVariant(ProductVariantDraft $variant = null, $staged = true)
    {
        $action = [
            static::ACTION => static::ADD_VARIANT,
        ];
        if (!is_null($variant)) {
            $action = $this->addValue($action, static::SKU, $variant->getSku());
            $action = $this->addValue($action, static::PRICES, $variant->getPrices());
            $action = $this->addValue($action, static::ATTRIBUTES, $variant->getAttributes());
        }

        return $this->addAction($action, $staged);
    }

    public function removeVariant($variantId, $staged = true)
    {
        return $this->addAction(
            [
                static::ACTION => static::REMOVE_VARIANT,
                static::ID => $variantId
            ],
            $staged
        );


    }

    public function setMetaAttributes(
        LocalizedString $metaTitle = null,
        LocalizedString $metaDescription = null,
        LocalizedString $metaKeywords = null,
        $staged = true
    ) {
        $action = [
            static::ACTION => static::ADD_VARIANT,
        ];
        $action = $this->addValue($action, static::META_TITLE, $metaTitle);
        $action = $this->addValue($action, static::META_DESCRIPTION, $metaDescription);
        $action = $this->addValue($action, static::META_KEYWORDS, $metaKeywords);

        return $this->addAction($action, $staged);


    }

    protected function priceAction($actionName, $variantId, Price $price, $staged)
    {
        return $this->addAction(
            [
                static::ACTION => $actionName,
                static::VARIANT_ID => $variantId,
                static::PRICE => $price
            ],
            $staged
        );
    }

    public function addPrice($variantId, Price $price, $staged = true)
    {
        return $this->priceAction(static::ADD_PRICE, $variantId, $price, $staged);
    }

    public function changePrice($variantId, Price $price, $staged = true)
    {
        return $this->priceAction(static::CHANGE_PRICE, $variantId, $price, $staged);
    }

    public function removePrice($variantId, Price $price, $staged = true)
    {
        return $this->priceAction(static::REMOVE_PRICE, $variantId, $price, $staged);
    }

    protected function attributeAction($actionName, $variantId, Attribute $attribute, $staged = true)
    {
        return $this->addAction(
            [
                static::ACTION => $actionName,
                static::VARIANT_ID => $variantId,
                static::NAME => $attribute->getName(),
                static::VALUE => $attribute->getValue()
            ],
            $staged
        );
    }

    public function setAttribute($variantId, Attribute $attribute, $staged = true)
    {
        return $this->attributeAction(static::SET_ATTRIBUTE, $variantId, $attribute, $staged);
    }

    public function setAttributeInAllVariants($variantId, Attribute $attribute, $staged = true)
    {
        return $this->attributeAction(static::SET_ATTRIBUTE_IN_ALL_VARIANTS, $variantId, $attribute, $staged);
    }

    public function addToCategory(CategoryReference $category, $staged = true)
    {
        return $this->addAction(
            [
                static::ACTION => static::ADD_TO_CATEGORY,
                static::CATEGORY => $category
            ],
            $staged
        );


    }

    public function removeFromCategory(CategoryReference $category, $staged = true)
    {
        return $this->addAction(
            [
                static::ACTION => static::REMOVE_FROM_CATEGORY,
                static::CATEGORY => $category
            ],
            $staged
        );


    }

    public function setTaxCategory(TaxCategoryReference $taxCategory, $staged = true)
    {
        return $this->addAction(
            [
                static::ACTION => static::SET_TAX_CATEGORY,
                static::TAX_CATEGORY => $taxCategory
            ],
            $staged
        );


    }

    public function setSKU($variantId, $sku = null, $staged = true)
    {
        return $this->addAction(
            [
                static::ACTION => static::SET_SKU,
                static::VARIANT_ID => $variantId,
                static::SKU => $sku
            ],
            $staged
        );


    }

    public function addExternalImage($variantId, $image, $staged = true)
    {
        return $this->addAction(
            [
                static::ACTION => static::ADD_EXTERNAL_IMAGE,
                static::VARIANT_ID => $variantId,
                static::IMAGE => $image
            ],
            $staged
        );


    }

    public function removeImage($variantId, $imageUrl, $staged = true)
    {
        return $this->addAction(
            [
                static::ACTION => static::REMOVE_IMAGE,
                static::VARIANT_ID => $variantId,
                static::IMAGE_URL => $imageUrl
            ],
            $staged
        );


    }

    public function setSearchKeywords($searchKeywords, $staged = true)
    {
        return $this->addAction(
            [
                static::ACTION => static::SET_SEARCH_KEYWORDS,
                static::SEARCH_KEYWORDS => $searchKeywords
            ],
            $staged
        );


    }

    public function revertStagedChanges()
    {
        return $this->addAction(
            [
                static::ACTION => static::REVERT_STAGED_CHANGES
            ],
            false
        );


    }

    public function publish()
    {
        return $this->addAction(
            [
                static::ACTION => static::PUBLISH
            ],
            false
        );


    }

    public function unpublish()
    {
        return $this->addAction(
            [
                static::ACTION => static::UNPUBLISH
            ],
            false
        );
    }
}
