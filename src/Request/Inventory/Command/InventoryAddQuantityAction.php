<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Inventory\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class InventoryAddQuantityAction
 * @package Sphere\Core\Request\Inventory\Command
 * 
 * @method string getAction()
 * @method InventoryAddQuantityAction setAction(string $action = null)
 * @method int getQuantity()
 * @method InventoryAddQuantityAction setQuantity(int $quantity = null)
 */
class InventoryAddQuantityAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
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
        $this->setAction('addQuantity');
    }

    /**
     * @param int $quantity
     * @param Context|callable $context
     * @return InventoryAddQuantityAction
     */
    public static function ofQuantity($quantity, $context = null)
    {
        return static::of($context)->setQuantity($quantity);
    }
}
