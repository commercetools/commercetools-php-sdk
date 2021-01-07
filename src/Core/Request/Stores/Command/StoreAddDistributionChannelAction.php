<?php

namespace Commercetools\Core\Request\Stores\Command;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Stores\Command
 * @link https://docs.commercetools.com/api/projects/stores#add-distribution-channel
 * @method string getAction()
 * @method StoreAddDistributionChannelAction setAction(string $action = null)
 * @method ChannelReference getDistributionChannel()
 * @method StoreAddDistributionChannelAction setDistributionChannel(ChannelReference $distributionChannel = null)
 */
class StoreAddDistributionChannelAction extends AbstractAction
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
        $this->setAction('addDistributionChannel');
    }

    /**
     * @param ChannelReference $distributionChannel
     * @param Context|callable $context
     * @return StoreAddDistributionChannelAction
     */
    public static function ofDistributionChannel(ChannelReference $distributionChannel, $context = null)
    {
        return static::of($context)->setDistributionChannel($distributionChannel);
    }
}
