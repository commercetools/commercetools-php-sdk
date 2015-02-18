<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;

use Sphere\Core\Request\AbstractAction;

class CartAddLineItemAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'productId' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'string'],
            'quantity' => [static::TYPE => 'int'],
        ];
    }

    /**
     * @param string $productId
     * @param string $variantId
     * @param int $quantity
     */
    public function __construct($productId, $variantId, $quantity)
    {
        $this->setAction('addLineItem');
        $this->setProductId($productId);
        $this->setVariantId($variantId);
        $this->setQuantity($quantity);
    }
}
