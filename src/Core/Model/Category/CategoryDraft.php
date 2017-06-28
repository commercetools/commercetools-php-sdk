<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 27.01.15, 10:51
 */

namespace Commercetools\Core\Model\Category;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\Common\AssetDraftCollection;

/**
 * @package Commercetools\Core\Model\Category
 * @link https://dev.commercetools.com/http-api-projects-categories.html#categorydraft
 * @method LocalizedString getName()
 * @method LocalizedString getSlug()
 * @method LocalizedString getDescription()
 * @method CategoryReference getParent()
 * @method string getOrderHint()
 * @method string getExternalId()
 * @method CategoryDraft setName(LocalizedString $name = null)
 * @method CategoryDraft setSlug(LocalizedString $slug = null)
 * @method CategoryDraft setDescription(LocalizedString $description = null)
 * @method CategoryDraft setParent(CategoryReference $parent = null)
 * @method CategoryDraft setOrderHint(string $orderHint = null)
 * @method CategoryDraft setExternalId(string $externalId = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method CategoryDraft setCustom(CustomFieldObjectDraft $custom = null)
 * @method LocalizedString getMetaDescription()
 * @method CategoryDraft setMetaDescription(LocalizedString $metaDescription = null)
 * @method LocalizedString getMetaTitle()
 * @method CategoryDraft setMetaTitle(LocalizedString $metaTitle = null)
 * @method LocalizedString getMetaKeywords()
 * @method CategoryDraft setMetaKeywords(LocalizedString $metaKeywords = null)
 * @method AssetDraftCollection getAssets()
 * @method CategoryDraft setAssets(AssetDraftCollection $assets = null)
 * @method string getKey()
 * @method CategoryDraft setKey(string $key = null)
 */
class CategoryDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'name' => [static::TYPE => LocalizedString::class],
            'slug' => [static::TYPE => LocalizedString::class],
            'description' => [static::TYPE => LocalizedString::class],
            'parent' => [static::TYPE => CategoryReference::class],
            'orderHint' => [static::TYPE => 'string'],
            'externalId' => [static::TYPE => 'string'],
            'metaDescription' => [static::TYPE => LocalizedString::class],
            'metaTitle' => [static::TYPE => LocalizedString::class],
            'metaKeywords' => [static::TYPE => LocalizedString::class],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class],
            'assets' => [static::TYPE => AssetDraftCollection::class],
            'key' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param LocalizedString $name
     * @param LocalizedString $slug
     * @param Context|callable $context
     * @return CategoryDraft
     */
    public static function ofNameAndSlug(LocalizedString $name, LocalizedString $slug, $context = null)
    {
        $draft = static::of($context);
        return $draft->setName($name)->setSlug($slug);
    }
}
