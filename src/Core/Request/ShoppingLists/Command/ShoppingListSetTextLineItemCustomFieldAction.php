<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShoppingLists\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;

/**
 * @package Commercetools\Core\Request\ShoppingLists\Command
 * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-textlineitem-customfield
 * @method string getAction()
 * @method ShoppingListSetTextLineItemCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method ShoppingListSetTextLineItemCustomFieldAction setName(string $name = null)
 * @method string getTextLineItemId()
 * @method ShoppingListSetTextLineItemCustomFieldAction setTextLineItemId(string $textLineItemId = null)
 * @method mixed getValue()
 * @method ShoppingListSetTextLineItemCustomFieldAction setValue($value = null)
 */
class ShoppingListSetTextLineItemCustomFieldAction extends SetCustomFieldAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string'],
            'textLineItemId' => [static::TYPE => 'string'],
            'value' => [static::TYPE => null],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setTextLineItemCustomField');
    }

    /**
     * @param string $textLineItemId
     * @param string $name
     * @param Context|callable $context
     * @return static
     */
    public static function ofTextLineItemIdAndName($textLineItemId, $name, $context = null)
    {
        return static::of($context)->setTextLineItemId($textLineItemId)->setName($name);
    }
}
