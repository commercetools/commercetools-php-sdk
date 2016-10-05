<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://dev.commercetools.com/http-api-projects-carts.html#change-customlineitem-quantity
 * @method string getAction()
 * @method CartChangeCustomLineItemQuantityAction setAction(string $action = null)
 * @method int getQuantity()
 * @method CartChangeCustomLineItemQuantityAction setQuantity(int $quantity = null)
 * @method string getCustomLineItemId()
 * @method CartChangeCustomLineItemQuantityAction setCustomLineItemId(string $customLineItemId = null)
 */
class CartChangeCustomLineItemQuantityAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'customLineItemId' => [static::TYPE => 'string'],
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
        $this->setAction('changeCustomLineItemQuantity');
    }

    /**
     * @param string $customLineItemId
     * @param int $quantity
     * @param Context|callable $context
     * @return CartChangeCustomLineItemQuantityAction
     */
    public static function ofCustomLineItemIdAndQuantity($customLineItemId, $quantity, $context = null)
    {
        return static::of($context)->setCustomLineItemId($customLineItemId)->setQuantity($quantity);
    }
}
