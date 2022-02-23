<?php
/**
 */

namespace Commercetools\Core\Model\ShoppingList;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\Store\StoreReference;

/**
 * @package Commercetools\Core\Model\ShoppingList
 * @link https://docs.commercetools.com/http-api-projects-me-shoppingLists#myshoppinglistdraft
 * @method LocalizedString getName()
 * @method MyShoppingListDraft setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method MyShoppingListDraft setDescription(LocalizedString $description = null)
 * @method LineItemDraftCollection getLineItems()
 * @method MyShoppingListDraft setLineItems(LineItemDraftCollection $lineItems = null)
 * @method TextLineItemDraftCollection getTextLineItems()
 * @method MyShoppingListDraft setTextLineItems(TextLineItemDraftCollection $textLineItems = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method MyShoppingListDraft setCustom(CustomFieldObjectDraft $custom = null)
 * @method int getDeleteDaysAfterLastModification()
 * @method MyShoppingListDraft setDeleteDaysAfterLastModification(int $deleteDaysAfterLastModification = null)
 * @method StoreReference getStore()
 * @method MyShoppingListDraft setStore(StoreReference $store = null)
 */
class MyShoppingListDraft extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'name' => [static::TYPE => LocalizedString::class],
            'description' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'lineItems' => [static::TYPE => LineItemDraftCollection::class, static::OPTIONAL => true],
            'textLineItems' => [static::TYPE => TextLineItemDraftCollection::class, static::OPTIONAL => true],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class, static::OPTIONAL => true],
            'deleteDaysAfterLastModification' => [static::TYPE => 'int', static::OPTIONAL => true],
            'store' => [static::TYPE => StoreReference::class, static::OPTIONAL => true],
        ];
    }

    /**
     * @param LocalizedString $name
     * @param Context|null $context
     * @return MyShoppingListDraft
     */
    public static function ofName(LocalizedString $name, $context = null)
    {
        return static::of($context)->setName($name);
    }
}
