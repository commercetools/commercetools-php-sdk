<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Request\Orders\Command
 * @link https://docs.commercetools.com/http-api-projects-orders.html#update-syncinfo
 * @method string getAction()
 * @method OrderUpdateSyncInfoAction setAction(string $action = null)
 * @method ChannelReference getChannel()
 * @method OrderUpdateSyncInfoAction setChannel(ChannelReference $channel = null)
 * @method string getExternalId()
 * @method OrderUpdateSyncInfoAction setExternalId(string $externalId = null)
 * @method DateTimeDecorator getSyncedAt()
 * @method OrderUpdateSyncInfoAction setSyncedAt(DateTime $syncedAt = null)
 */
class OrderUpdateSyncInfoAction extends AbstractAction
{
    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('updateSyncInfo');
    }

    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'channel' => [static::TYPE => ChannelReference::class],
            'externalId' => [static::TYPE => 'string'],
            'syncedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ]
        ];
    }

    /**
     * @param ChannelReference $channel
     * @param Context|callable $context
     * @return OrderUpdateSyncInfoAction
     */
    public static function ofChannel(ChannelReference $channel, $context = null)
    {
        return static::of($context)->setChannel($channel);
    }
}
