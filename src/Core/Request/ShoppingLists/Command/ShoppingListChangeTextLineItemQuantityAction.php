<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShoppingLists\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ShoppingLists\Command
 * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#change-textlineitem-quantity
 * @method string getAction()
 * @method ShoppingListChangeTextLineItemQuantityAction setAction(string $action = null)
 * @method string getTextLineItemId()
 * @method ShoppingListChangeTextLineItemQuantityAction setTextLineItemId(string $textLineItemId = null)
 * @method int getQuantity()
 * @method ShoppingListChangeTextLineItemQuantityAction setQuantity(int $quantity = null)
 */
class ShoppingListChangeTextLineItemQuantityAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'textLineItemId' => [static::TYPE => 'string'],
            'quantity' => [static::TYPE => 'int'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeTextLineItemQuantity');
    }

    /**
     * @param string $textLineItemId
     * @param int $quantity
     * @param Context|callable $context
     * @return ShoppingListChangeTextLineItemQuantityAction
     */
    public static function ofTextLineItemIdAndQuantity($textLineItemId, $quantity, $context = null)
    {
        return static::of($context)->setTextLineItemId($textLineItemId)->setQuantity($quantity);
    }
}
