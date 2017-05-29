<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShoppingLists\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ShoppingLists\Command
 * @link https://dev.commercetools.com/http-api-projects-shoppingLists.html#change-lineitem-quantity
 * @method string getAction()
 * @method ShoppingListChangeLineItemQuantityAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method ShoppingListChangeLineItemQuantityAction setLineItemId(string $lineItemId = null)
 * @method int getQuantity()
 * @method ShoppingListChangeLineItemQuantityAction setQuantity(int $quantity = null)
 */
class ShoppingListChangeLineItemQuantityAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'lineItemId' => [static::TYPE => 'string'],
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
        $this->setAction('changeLineItemQuantity');
    }

    /**
     * @param string $lineItemId
     * @param int $quantity
     * @param Context|callable $context
     * @return ShoppingListChangeLineItemQuantityAction
     */
    public static function ofLineItemIdAndQuantity($lineItemId, $quantity, $context = null)
    {
        return static::of($context)->setLineItemId($lineItemId)->setQuantity($quantity);
    }
}
