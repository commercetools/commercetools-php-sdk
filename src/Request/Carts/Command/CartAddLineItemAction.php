<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CartAddLineItemAction
 * @package Sphere\Core\Request\Carts\Command
 * @method string getAction()
 * @method CartAddLineItemAction setAction(string $action)
 * @method string getProductId()
 * @method CartAddLineItemAction setProductId(string $productId)
 * @method string getVariantId()
 * @method CartAddLineItemAction setVariantId(string $variantId)
 * @method int getQuantity()
 * @method CartAddLineItemAction setQuantity(int $quantity)
 */
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
