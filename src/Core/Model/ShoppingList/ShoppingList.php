<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShoppingList;

use Commercetools\Core\Model\Common\CreatedBy;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\LastModifiedBy;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Customer\CustomerReference;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\Store\StoreReference;
use DateTime;

/**
 * @package Commercetools\Core\Model\ShoppingList
 * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#shoppingList
 * @method string getId()
 * @method ShoppingList setId(string $id = null)
 * @method string getKey()
 * @method ShoppingList setKey(string $key = null)
 * @method int getVersion()
 * @method ShoppingList setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ShoppingList setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ShoppingList setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method LocalizedString getSlug()
 * @method ShoppingList setSlug(LocalizedString $slug = null)
 * @method LocalizedString getName()
 * @method ShoppingList setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method ShoppingList setDescription(LocalizedString $description = null)
 * @method CustomerReference getCustomer()
 * @method ShoppingList setCustomer(CustomerReference $customer = null)
 * @method LineItemCollection getLineItems()
 * @method ShoppingList setLineItems(LineItemCollection $lineItems = null)
 * @method TextLineItemCollection getTextLineItems()
 * @method ShoppingList setTextLineItems(TextLineItemCollection $textLineItems = null)
 * @method CustomFieldObject getCustom()
 * @method ShoppingList setCustom(CustomFieldObject $custom = null)
 * @method int getDeleteDaysAfterLastModification()
 * @method ShoppingList setDeleteDaysAfterLastModification(int $deleteDaysAfterLastModification = null)
 * @method string getAnonymousId()
 * @method ShoppingList setAnonymousId(string $anonymousId = null)
 * @method CreatedBy getCreatedBy()
 * @method ShoppingList setCreatedBy(CreatedBy $createdBy = null)
 * @method LastModifiedBy getLastModifiedBy()
 * @method ShoppingList setLastModifiedBy(LastModifiedBy $lastModifiedBy = null)
 * @method StoreReference getStore()
 * @method ShoppingList setStore(StoreReference $store = null)
 * @method ShoppingListReference getReference()
 */
class ShoppingList extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string', static::OPTIONAL => true],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'slug' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'name' => [static::TYPE => LocalizedString::class],
            'description' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'customer' => [static::TYPE => CustomerReference::class, static::OPTIONAL => true],
            'lineItems' => [static::TYPE => LineItemCollection::class, static::OPTIONAL => true],
            'textLineItems' => [static::TYPE => TextLineItemCollection::class, static::OPTIONAL => true],
            'custom' => [static::TYPE => CustomFieldObject::class, static::OPTIONAL => true],
            'deleteDaysAfterLastModification' => [static::TYPE => 'int', static::OPTIONAL => true],
            'anonymousId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'createdBy' => [static::TYPE => CreatedBy::class, static::OPTIONAL => true],
            'lastModifiedBy' => [static::TYPE => LastModifiedBy::class, static::OPTIONAL => true],
            'store' => [static::TYPE => StoreReference::class, static::OPTIONAL => true],
        ];
    }
}
