<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShoppingList;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Customer\CustomerReference;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use DateTime;

/**
 * @package Commercetools\Core\Model\ShoppingList
 * @link https://dev.commercetools.com/http-api-projects-shoppingLists.html#shoppingList
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
 */
class ShoppingList extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'slug' => [static::TYPE => LocalizedString::class],
            'name' => [static::TYPE => LocalizedString::class],
            'description' => [static::TYPE => LocalizedString::class],
            'customer' => [static::TYPE => CustomerReference::class],
            'lineItems' => [static::TYPE => LineItemCollection::class],
            'textLineItems' => [static::TYPE => TextLineItemCollection::class],
            'custom' => [static::TYPE => CustomFieldObject::class],
            'deleteDaysAfterLastModification' => [static::TYPE => 'int']
        ];
    }
}
