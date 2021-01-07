<?php

namespace Commercetools\Core\Request\Stores\Command;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Stores\Command
 * @link https://docs.commercetools.com/api/projects/stores#remove-distribution-channel
 * @method string getAction()
 * @method StoreRemoveDistributionChannelAction setAction(string $action = null)
 * @method ChannelReference getDistributionChannel()
 * @method StoreRemoveDistributionChannelAction setDistributionChannel(ChannelReference $distributionChannel = null)
 */
class StoreRemoveDistributionChannelAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
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
        $this->setAction('removeDistributionChannel');
    }

    /**
     * @param ChannelReference $distributionChannel
     * @param Context|callable $context
     * @return StoreRemoveDistributionChannelAction
     */
    public static function ofDistributionChannel(ChannelReference $distributionChannel, $context = null)
    {
        return static::of($context)->setDistributionChannel($distributionChannel);
    }
}
