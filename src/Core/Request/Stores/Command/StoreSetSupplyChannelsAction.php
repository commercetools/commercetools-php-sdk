<?php

namespace Commercetools\Core\Request\Stores\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Stores\Command
 * @link https://docs.commercetools.com/api/projects/stores#set-supply-channels
 *
 * @method string getAction()
 * @method StoreSetSupplyChannelsAction setAction(string $action = null)
 * @method array getSupplyChannels()
 * @method StoreSetSupplyChannelsAction setSupplyChannels(array $supplyChannels = null)
 */
class StoreSetSupplyChannelsAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'supplyChannels' => [static::TYPE => 'array'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setSupplyChannels');
    }

    /**
     * @param array $supplyChannels
     * @param Context|callable $context
     * @return StoreSetSupplyChannelsAction
     */
    public static function ofSupplyChannels(array $supplyChannels, $context = null)
    {
        return static::of($context)->setSupplyChannels($supplyChannels);
    }
}
