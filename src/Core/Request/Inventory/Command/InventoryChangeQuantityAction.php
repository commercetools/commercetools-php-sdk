<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Inventory\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Inventory\Command
 * @link https://docs.commercetools.com/http-api-projects-inventory.html#change-quantity
 * @method string getAction()
 * @method InventoryChangeQuantityAction setAction(string $action = null)
 * @method int getQuantity()
 * @method InventoryChangeQuantityAction setQuantity(int $quantity = null)
 */
class InventoryChangeQuantityAction extends AbstractAction
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
