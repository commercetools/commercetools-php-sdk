<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShoppingLists\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ShoppingLists\Command
 * @link https://dev.commercetools.com/http-api-projects-shoppingLists.html#change-lineitems-order
 * @method string getAction()
 * @method ShoppingListChangeLineItemsOrderAction setAction(string $action = null)
 * @method array getLineItemOrder()
 * @method ShoppingListChangeLineItemsOrderAction setLineItemOrder(array $lineItemOrder = null)
 */
class ShoppingListChangeLineItemsOrderAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'lineItemOrder' => [static::TYPE => 'array'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeLineItemsOrder');
    }

    /**
     * @param array $lineItemOrder
     * @param Context|callable $context
     * @return ShoppingListChangeLineItemsOrderAction
     */
    public static function ofLineItemIdOrder(array $lineItemOrder, $context = null)
    {
        return static::of($context)->setLineItemOrder($lineItemOrder);
    }
}
