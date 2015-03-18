<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CartRemoveLineItemAction
 * @package Sphere\Core\Request\Carts\Command
 * @method string getAction()
 * @method CartRemoveLineItemAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method CartRemoveLineItemAction setLineItemId(string $lineItemId = null)
 * @method int getQuantity()
 * @method CartRemoveLineItemAction setQuantity(int $quantity = null)
 */
class CartRemoveLineItemAction extends AbstractAction
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
     */
    public function __construct($lineItemId)
    {
        $this->setAction('removeLineItem');
        $this->setLineItemId($lineItemId);
    }
}
