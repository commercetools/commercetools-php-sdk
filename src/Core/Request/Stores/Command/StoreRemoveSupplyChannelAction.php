<?php

namespace Commercetools\Core\Request\Stores\Command;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Stores\Command
 * @link https://docs.commercetools.com/api/projects/stores#remove-supply-channel
 *
 * @method string getAction()
 * @method StoreRemoveSupplyChannelAction setAction(string $action = null)
 * @method ChannelReference getSupplyChannel()
 * @method StoreRemoveSupplyChannelAction setSupplyChannel(ChannelReference $supplyChannel = null)
 */
class StoreRemoveSupplyChannelAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'supplyChannel' => [static::TYPE => ChannelReference::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('removeSupplyChannel');
    }

    /**
     * @param ChannelReference $supplyChannel
     * @param Context|callable $context
     * @return StoreRemoveSupplyChannelAction
     */
    public static function ofSupplyChannel(ChannelReference $supplyChannel, $context = null)
    {
        StoreRemoveSupplyChannelAction::class;
        return static::of($context)->setSupplyChannel($supplyChannel);
    }
}
