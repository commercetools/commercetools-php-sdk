<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShoppingList;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use DateTime;

/**
 * @package Commercetools\Core\Model\ShoppingList
 *
 * @method string getId()
 * @method TextLineItem setId(string $id = null)
 * @method LocalizedString getName()
 * @method TextLineItem setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method TextLineItem setDescription(LocalizedString $description = null)
 * @method int getQuantity()
 * @method TextLineItem setQuantity(int $quantity = null)
 * @method DateTimeDecorator getAddedAt()
 * @method TextLineItem setAddedAt(DateTime $addedAt = null)
 * @method CustomFieldObject getCustom()
 * @method TextLineItem setCustom(CustomFieldObject $custom = null)
 */
class TextLineItem extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'name' => [static::TYPE => LocalizedString::class],
            'description' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'quantity' => [static::TYPE => 'int'],
            'addedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'custom' => [static::TYPE => CustomFieldObject::class, static::OPTIONAL => true],
        ];
    }
}
