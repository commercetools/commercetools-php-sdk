<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShoppingLists\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;

/**
 * @package Commercetools\Core\Request\ShoppingLists\Command
 * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#set-lineitem-customfield
 * @method string getAction()
 * @method ShoppingListSetLineItemCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method ShoppingListSetLineItemCustomFieldAction setName(string $name = null)
 * @method string getLineItemId()
 * @method ShoppingListSetLineItemCustomFieldAction setLineItemId(string $lineItemId = null)
 * @method mixed getValue()
 * @method ShoppingListSetLineItemCustomFieldAction setValue($value = null)
 */
class ShoppingListSetLineItemCustomFieldAction extends SetCustomFieldAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string'],
            'lineItemId' => [static::TYPE => 'string'],
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
        $this->setAction('setLineItemCustomField');
    }

    /**
     * @param string $lineItemId
     * @param string $name
     * @param Context|callable $context
     * @return static
     */
    public static function ofLineItemIdAndName($lineItemId, $name, $context = null)
    {
        return static::of($context)->setLineItemId($lineItemId)->setName($name);
    }
}
