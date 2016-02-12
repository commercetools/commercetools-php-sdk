<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Inventory\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Inventory\Command
 * @link https://dev.commercetools.com/http-api-projects-inventory.html#remove-quantity
 * @method string getAction()
 * @method InventoryRemoveQuantityAction setAction(string $action = null)
 * @method int getQuantity()
 * @method InventoryRemoveQuantityAction setQuantity(int $quantity = null)
 */
class InventoryRemoveQuantityAction extends AbstractAction
{
    public function fieldDefinitions()
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
        $this->setAction('removeQuantity');
    }

    /**
     * @param int $quantity
     * @param Context|callable $context
     * @return InventoryRemoveQuantityAction
     */
    public static function ofQuantity($quantity, $context = null)
    {
        return static::of($context)->setQuantity($quantity);
    }
}
