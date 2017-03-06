<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShoppingLists\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ShoppingLists\Command
 * @link https://dev.commercetools.com/http-api-projects-shoppingLists.html#change-textlineitems-order
 * @method string getAction()
 * @method ShoppingListChangeTextLineItemsOrderAction setAction(string $action = null)
 * @method array getTextLineItemOrder()
 * @method ShoppingListChangeTextLineItemsOrderAction setTextLineItemOrder(array $textLineItemOrder = null)
 */
class ShoppingListChangeTextLineItemsOrderAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'textLineItemOrder' => [static::TYPE => 'array'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeTextLineItemsOrder');
    }

    /**
     * @param array $textLineItemOrder
     * @param Context|callable $context
     * @return ShoppingListChangeTextLineItemsOrderAction
     */
    public static function ofTextLineItemIdOrder(array $textLineItemOrder, $context = null)
    {
        return static::of($context)->setTextLineItemOrder($textLineItemOrder);
    }
}
