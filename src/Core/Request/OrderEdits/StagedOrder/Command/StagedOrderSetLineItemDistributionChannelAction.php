<?php

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Carts\Command\CartSetLineItemDistributionChannelAction;
use Commercetools\Core\Model\Channel\ChannelReference;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetLineItemDistributionChannelAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method StagedOrderSetLineItemDistributionChannelAction setLineItemId(string $lineItemId = null)
 * @method ChannelReference getDistributionChannel()
 * phpcs:disable
 * @method StagedOrderSetLineItemDistributionChannelAction setDistributionChannel(ChannelReference $distributionChannel = null)
 * phpcs:enable
 */
// phpcs:ignore
class StagedOrderSetLineItemDistributionChannelAction extends CartSetLineItemDistributionChannelAction implements StagedOrderUpdateAction
{
}
