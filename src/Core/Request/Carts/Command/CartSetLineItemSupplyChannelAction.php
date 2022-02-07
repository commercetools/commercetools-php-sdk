<?php

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\ResourceIdentifier;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 *
 * @method string getAction()
 * @method CartSetLineItemSupplyChannelAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method CartSetLineItemSupplyChannelAction setLineItemId(string $lineItemId = null)
 * @method ChannelReference getSupplyChannel()
 * @method CartSetLineItemSupplyChannelAction setSupplyChannel(ChannelReference $supplyChannel = null)
 */
class CartSetLineItemSupplyChannelAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'lineItemId' => [static::TYPE => 'string'],
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
        $this->setAction('setLineItemSupplyChannel');
    }

    /**
     * @param String $itemLineId
     * @param ResourceIdentifier|ChannelReference $supplyChannel
     * @param Context|callable $context
     * @return CartSetLineItemSupplyChannelAction
     */
    public static function ofItemLineIdAndSupplyChannel($itemLineId, ChannelReference $supplyChannel, $context = null)
    {
        return static::of($context)->setLineItemId($itemLineId)->setSupplyChannel($supplyChannel);
    }
}
