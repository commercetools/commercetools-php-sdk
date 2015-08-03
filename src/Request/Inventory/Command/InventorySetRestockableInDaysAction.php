<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Inventory\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Inventory\Command
 * 
 * @method string getAction()
 * @method InventorySetRestockableInDaysAction setAction(string $action = null)
 * @method int getRestockableInDays()
 * @method InventorySetRestockableInDaysAction setRestockableInDays(int $restockableInDays = null)
 */
class InventorySetRestockableInDaysAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'restockableInDays' => [static::TYPE => 'int'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setRestockableInDays');
    }
}
