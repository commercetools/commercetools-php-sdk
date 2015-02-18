<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;

use Sphere\Core\Request\AbstractAction;

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
