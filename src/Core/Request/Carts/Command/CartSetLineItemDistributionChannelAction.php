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
 * @method CartSetLineItemDistributionChannelAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method CartSetLineItemDistributionChannelAction setLineItemId(string $lineItemId = null)
 * @method ChannelReference getDistributionChannel()
 * phpcs:disable
 * @method CartSetLineItemDistributionChannelAction setDistributionChannel(ChannelReference $distributionChannel = null)
 * phpcs:enable
 */
class CartSetLineItemDistributionChannelAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'lineItemId' => [static::TYPE => 'string'],
            'distributionChannel' => [static::TYPE => ChannelReference::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setLineItemDistributionChannel');
    }

    /**
     * @param String $itemLineId
     * @param ResourceIdentifier|ChannelReference $distributionChannel
     * @param Context|callable $context
     * @return CartSetLineItemDistributionChannelAction
     */
    public static function ofItemLineIdAndDistributionChannel($itemLineId, ChannelReference $distributionChannel, $context = null)
    {
        return static::of($context)->setLineItemId($itemLineId)->setDistributionChannel($distributionChannel);
    }
}
