<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Category;

use Commercetools\Core\Model\Common\CreatedBy;
use Commercetools\Core\Model\Common\LastModifiedBy;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\AssetCollection;
use DateTime;

/**
 * @package Commercetools\Core\Model\Category
 * @link https://docs.commercetools.com/http-api-projects-categories.html#category
 * @method string getId()
 * @method Category setId(string $id = null)
 * @method int getVersion()
 * @method Category setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Category setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method Category setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method LocalizedString getName()
 * @method Category setName(LocalizedString $name = null)
 * @method LocalizedString getSlug()
 * @method Category setSlug(LocalizedString $slug = null)
 * @method LocalizedString getDescription()
 * @method Category setDescription(LocalizedString $description = null)
 * @method CategoryReferenceCollection getAncestors()
 * @method Category setAncestors(CategoryReferenceCollection $ancestors = null)
 * @method CategoryReference getParent()
 * @method Category setParent(CategoryReference $parent = null)
 * @method string getOrderHint()
 * @method Category setOrderHint(string $orderHint = null)
 * @method string getExternalId()
 * @method Category setExternalId(string $externalId = null)
 * @method CustomFieldObject getCustom()
 * @method Category setCustom(CustomFieldObject $custom = null)
 * @method LocalizedString getMetaDescription()
 * @method Category setMetaDescription(LocalizedString $metaDescription = null)
 * @method LocalizedString getMetaTitle()
 * @method Category setMetaTitle(LocalizedString $metaTitle = null)
 * @method LocalizedString getMetaKeywords()
 * @method Category setMetaKeywords(LocalizedString $metaKeywords = null)
 * @method AssetCollection getAssets()
 * @method Category setAssets(AssetCollection $assets = null)
 * @method string getKey()
 * @method Category setKey(string $key = null)
 * @method CreatedBy getCreatedBy()
 * @method Category setCreatedBy(CreatedBy $createdBy = null)
 * @method LastModifiedBy getLastModifiedBy()
 * @method Category setLastModifiedBy(LastModifiedBy $lastModifiedBy = null)
 * @method CategoryReference getReference()
 */
class Category extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'name' => [static::TYPE => LocalizedString::class],
            'slug' => [static::TYPE => LocalizedString::class],
            'description' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'ancestors' => [static::TYPE => CategoryReferenceCollection::class],
            'parent' => [static::TYPE => CategoryReference::class, static::OPTIONAL => true],
            'orderHint' => [static::TYPE => 'string'],
            'externalId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'metaDescription' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'metaTitle' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'metaKeywords' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'custom' => [static::TYPE => CustomFieldObject::class, static::OPTIONAL => true],
            'assets' => [static::TYPE => AssetCollection::class, static::OPTIONAL => true],
            'key' => [static::TYPE => 'string', static::OPTIONAL => true],
            'createdBy' => [static::TYPE => CreatedBy::class, static::OPTIONAL => true],
            'lastModifiedBy' => [static::TYPE => LastModifiedBy::class, static::OPTIONAL => true],
        ];
    }
}
