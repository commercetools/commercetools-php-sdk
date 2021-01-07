<?php

namespace Commercetools\Core\Request\Stores\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Stores\Command
 * @link https://docs.commercetools.com/api/projects/stores#set-distribution-channels
 * @method string getAction()
 * @method StoreSetDistributionChannelsAction setAction(string $action = null)
 * @method StoreSetDistributionChannelsAction setDistributionChannels(array $distributionChannels = null)
 * @method array getDistributionChannels()
 */
class StoreSetDistributionChannelsAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'distributionChannels' => [static::TYPE => 'array'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setDistributionChannels');
    }

    /**
     * @param array $distributionChannels
     * @param Context|callable $context
     * @return StoreSetDistributionChannelsAction
     */
    public static function ofDistributionChannels(array $distributionChannels, $context = null)
    {
        return static::of($context)->setDistributionChannels($distributionChannels);
    }
}
