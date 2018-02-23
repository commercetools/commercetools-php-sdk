<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShoppingLists\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ShoppingLists\Command
 * @link https://docs.commercetools.com/http-api-projects-shoppingLists.html#remove-textlineitem
 * @method string getAction()
 * @method ShoppingListRemoveTextLineItemAction setAction(string $action = null)
 * @method string getTextLineItemId()
 * @method ShoppingListRemoveTextLineItemAction setTextLineItemId(string $textLineItemId = null)
 * @method int getQuantity()
 * @method ShoppingListRemoveTextLineItemAction setQuantity(int $quantity = null)
 */
class ShoppingListRemoveTextLineItemAction extends AbstractAction
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
        $this->setAction('removeTextLineItem');
    }

    /**
     * @param string $textLineItemId
     * @param Context|callable $context
     * @return ShoppingListRemoveTextLineItemAction
     */
    public static function ofTextLineItemId($textLineItemId, $context = null)
    {
        return static::of($context)->setTextLineItemId($textLineItemId);
    }
}
