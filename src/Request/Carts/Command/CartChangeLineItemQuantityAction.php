<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CartChangeLineItemQuantityAction
 * @package Sphere\Core\Request\Carts\Command
 * @link http://dev.sphere.io/http-api-projects-carts.html#change-line-item-quantity
 * @method string getAction()
 * @method CartChangeLineItemQuantityAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method CartChangeLineItemQuantityAction setLineItemId(string $lineItemId = null)
 * @method int getQuantity()
 * @method CartChangeLineItemQuantityAction setQuantity(int $quantity = null)
 */
class CartChangeLineItemQuantityAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'lineItemId' => [static::TYPE => 'string'],
            'quantity' => [static::TYPE => 'int'],
        ];
    }

    /**
     * @param string $lineItemId
     * @param int $quantity
     */
    public function __construct($lineItemId, $quantity)
    {
        $this->setAction('changeLineItemQuantity');
        $this->setLineItemId($lineItemId);
        $this->setQuantity($quantity);
    }
}
