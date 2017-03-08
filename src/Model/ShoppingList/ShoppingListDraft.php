<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShoppingList;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Customer\CustomerReference;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;

/**
 * @package Commercetools\Core\Model\ShoppingList
 * @link https://dev.commercetools.com/http-api-projects-shoppingLists.html#shoppingListDraft
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
 */
class ShoppingListDraft extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'key' => [static::TYPE => 'string'],
            'slug' => [static::TYPE => LocalizedString::class],
            'name' => [static::TYPE => LocalizedString::class],
            'description' => [static::TYPE => LocalizedString::class],
            'customer' => [static::TYPE => CustomerReference::class],
            'lineItems' => [static::TYPE => LineItemDraftCollection::class],
            'textLineItems' => [static::TYPE => TextLineItemDraftCollection::class],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class],
        ];
    }

    /**
     * @param string $name
     * @param Context|null $context
     * @return ShoppingListDraft
     */
    public static function ofName($name, $context = null)
    {
        return static::of($context)->setName($name);
    }

    /**
     * @param string $name
     * @param string $key
     * @param Context|null $context
     * @return ShoppingListDraft
     */
    public static function ofNameAndKey($name, $key, $context = null)
    {
        return static::of($context)->setName($name)->setKey($key);
    }
}
