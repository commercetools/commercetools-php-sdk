<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders\Command;

use Sphere\Core\Model\Channel\ChannelReference;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;
use Sphere\Core\Model\Common\DateTimeDecorator;

/**
 * @package Sphere\Core\Request\Orders\Command
 * @link http://dev.sphere.io/http-api-projects-orders.html#update-sync-info
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
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('updateSyncInfo');
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
