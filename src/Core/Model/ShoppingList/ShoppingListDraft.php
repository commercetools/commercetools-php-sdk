<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShoppingList;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Customer\CustomerReference;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\Store\StoreReference;

/**
 * @package Commercetools\Core\Model\ShoppingList
 * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#shoppingListDraft
 * @method string getKey()
 * @method ShoppingListDraft setKey(string $key = null)
 * @method LocalizedString getSlug()
 * @method ShoppingListDraft setSlug(LocalizedString $slug = null)
 * @method LocalizedString getName()
 * @method ShoppingListDraft setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method ShoppingListDraft setDescription(LocalizedString $description = null)
 * @method CustomerReference getCustomer()
 * @method ShoppingListDraft setCustomer(CustomerReference $customer = null)
 * @method LineItemDraftCollection getLineItems()
 * @method ShoppingListDraft setLineItems(LineItemDraftCollection $lineItems = null)
 * @method TextLineItemDraftCollection getTextLineItems()
 * @method ShoppingListDraft setTextLineItems(TextLineItemDraftCollection $textLineItems = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method ShoppingListDraft setCustom(CustomFieldObjectDraft $custom = null)
 * @method int getDeleteDaysAfterLastModification()
 * @method ShoppingListDraft setDeleteDaysAfterLastModification(int $deleteDaysAfterLastModification = null)
 * @method string getAnonymousId()
 * @method ShoppingListDraft setAnonymousId(string $anonymousId = null)
 * @method StoreReference getStore()
 * @method ShoppingListDraft setStore(StoreReference $store = null)
 */
class ShoppingListDraft extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'key' => [static::TYPE => 'string', static::OPTIONAL => true],
            'slug' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'name' => [static::TYPE => LocalizedString::class],
            'description' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'customer' => [static::TYPE => CustomerReference::class, static::OPTIONAL => true],
            'lineItems' => [static::TYPE => LineItemDraftCollection::class, static::OPTIONAL => true],
            'textLineItems' => [static::TYPE => TextLineItemDraftCollection::class, static::OPTIONAL => true],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class, static::OPTIONAL => true],
            'deleteDaysAfterLastModification' => [static::TYPE => 'int', static::OPTIONAL => true],
            'anonymousId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'store' => [static::TYPE => StoreReference::class, static::OPTIONAL => true],
        ];
    }

    /**
     * @param LocalizedString $name
     * @param Context|null $context
     * @return ShoppingListDraft
     */
    public static function ofName($name, $context = null)
    {
        return static::of($context)->setName($name);
    }

    /**
     * @param LocalizedString $name
     * @param string $key
     * @param Context|null $context
     * @return ShoppingListDraft
     */
    public static function ofNameAndKey($name, $key, $context = null)
    {
        return static::of($context)->setName($name)->setKey($key);
    }
}
