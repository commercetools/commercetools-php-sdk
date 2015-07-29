<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Inventory\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\Inventory\Command
 * 
 * @method string getAction()
 * @method InventoryChangeQuantityAction setAction(string $action = null)
 * @method int getQuantity()
 * @method InventoryChangeQuantityAction setQuantity(int $quantity = null)
 */
class InventoryChangeQuantityAction extends AbstractAction
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
        $this->setAction('changeQuantity');
    }

    /**
     * @param int $quantity
     * @param Context|callable $context
     * @return InventoryChangeQuantityAction
     */
    public static function ofQuantity($quantity, $context = null)
    {
        return static::of($context)->setQuantity($quantity);
    }
}
