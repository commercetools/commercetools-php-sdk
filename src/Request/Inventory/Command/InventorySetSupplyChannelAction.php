<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Request\Inventory\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Channel\Channel;

/**
 * @package Commercetools\Core\Request\Inventory\Command
 *
 * @method string getAction()
 * @method InventorySetSupplyChannelAction setAction(string $action = null)
 * @method Channel getSupplyChannel()
 * @method InventorySetSupplyChannelAction setSupplyChannel(Channel $supplyChannel = null)
 */
class InventorySetSupplyChannelAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'supplyChannel' => [static::TYPE => '\Commercetools\Core\Model\Channel\Channel'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setSupplyChannel');
    }
}
