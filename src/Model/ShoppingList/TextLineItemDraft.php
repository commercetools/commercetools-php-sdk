<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShoppingList;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use DateTime;

/**
 * @package Commercetools\Core\Model\ShoppingList
 *
 * @method LocalizedString getName()
 * @method TextLineItemDraft setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method TextLineItemDraft setDescription(LocalizedString $description = null)
 * @method int getQuantity()
 * @method TextLineItemDraft setQuantity(int $quantity = null)
 * @method DateTimeDecorator getAddedAt()
 * @method TextLineItemDraft setAddedAt(DateTime $addedAt = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method TextLineItemDraft setCustom(CustomFieldObjectDraft $custom = null)
 */
class TextLineItemDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'name' => [static::TYPE => LocalizedString::class],
            'description' => [static::TYPE => LocalizedString::class],
            'quantity' => [static::TYPE => 'int'],
            'addedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class],
        ];
    }
}
