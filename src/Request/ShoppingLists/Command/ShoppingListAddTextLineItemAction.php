<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShoppingLists\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use DateTime;

/**
 * @package Commercetools\Core\Request\ShoppingLists\Command
 * @link https://dev.commercetools.com/http-api-projects-shoppingLists.html#add-textlineitem
 * @method string getAction()
 * @method ShoppingListAddTextLineItemAction setAction(string $action = null)
 * @method LocalizedString getName()
 * @method ShoppingListAddTextLineItemAction setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method ShoppingListAddTextLineItemAction setDescription(LocalizedString $description = null)
 * @method int getQuantity()
 * @method ShoppingListAddTextLineItemAction setQuantity(int $quantity = null)
 * @method DateTimeDecorator getAddedAt()
 * @method ShoppingListAddTextLineItemAction setAddedAt(DateTime $addedAt = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method ShoppingListAddTextLineItemAction setCustom(CustomFieldObjectDraft $custom = null)
 */
class ShoppingListAddTextLineItemAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
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

    /**
     * @param LocalizedString $name
     * @param Context|callable $context
     * @return ShoppingListAddTextLineItemAction
     */
    public static function ofName(LocalizedString $name, $context = null)
    {
        return static::of($context)->setName($name);
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addTextLineItem');
    }
}
