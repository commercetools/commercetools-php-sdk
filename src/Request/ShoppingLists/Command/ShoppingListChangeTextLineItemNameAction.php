<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShoppingLists\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ShoppingLists\Command
 * @link https://dev.commercetools.com/http-api-projects-shoppingLists.html#change-textlineitem-name
 * @method string getAction()
 * @method ShoppingListChangeTextLineItemNameAction setAction(string $action = null)
 * @method string getTextLineItemId()
 * @method ShoppingListChangeTextLineItemNameAction setTextLineItemId(string $textLineItemId = null)
 * @method LocalizedString getName()
 * @method ShoppingListChangeTextLineItemNameAction setName(LocalizedString $name = null)
 */
class ShoppingListChangeTextLineItemNameAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'textLineItemId' => [static::TYPE => 'string'],
            'name' => [static::TYPE => LocalizedString::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeTextLineItemName');
    }

    /**
     * @param string $textLineItemId
     * @param LocalizedString $name
     * @param Context|callable $context
     * @return ShoppingListChangeTextLineItemNameAction
     */
    public static function ofTextLineItemIdAndName($textLineItemId, $name, $context = null)
    {
        return static::of($context)->setTextLineItemId($textLineItemId)->setName($name);
    }
}
