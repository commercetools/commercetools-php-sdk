<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders\Command;

use Sphere\Core\Model\Channel\ChannelReference;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;
use \Sphere\Core\Model\Common\DateTimeDecorator;

/**
 * Class OrderUpdateSyncInfoAction
 * @package Sphere\Core\Request\Orders\Command
 * @method string getAction()
 * @method OrderUpdateSyncInfoAction setAction(string $action = null)
 * @method ChannelReference getChannel()
 * @method OrderUpdateSyncInfoAction setChannel(ChannelReference $channel = null)
 * @method string getExternalId()
 * @method OrderUpdateSyncInfoAction setExternalId(string $externalId = null)
 * @method DateTimeDecorator getSyncedAt()
 * @method OrderUpdateSyncInfoAction setSyncedAt(\DateTime $syncedAt = null)
 */
class OrderUpdateSyncInfoAction extends AbstractAction
{
    /**
     * @param ChannelReference $channel
     * @param Context $context
     */
    public function __construct(ChannelReference $channel, Context $context = null)
    {
        $this->setContext($context)
            ->setAction('updateSyncInfo')
            ->setChannel($channel);
    }

    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'channel' => [static::TYPE => '\Sphere\Core\Model\Channel\ChannelReference'],
            'externalId' => [static::TYPE => 'string'],
            'syncedAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Sphere\Core\Model\Common\DateTimeDecorator'
            ]
        ];
    }
}
