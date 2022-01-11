<?php

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Message
 *
 * @method string getId()
 * @method OrderLineItemDistributionChannelSetMessage setId(string $id = null)
 * @method int getVersion()
 * @method OrderLineItemDistributionChannelSetMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method OrderLineItemDistributionChannelSetMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method OrderLineItemDistributionChannelSetMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method OrderLineItemDistributionChannelSetMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method OrderLineItemDistributionChannelSetMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method OrderLineItemDistributionChannelSetMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method OrderLineItemDistributionChannelSetMessage setType(string $type = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method OrderLineItemDistributionChannelSetMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 * @method string getLineItemId()
 * @method OrderLineItemDistributionChannelSetMessage setLineItemId(string $lineItemId = null)
 * @method ChannelReference getDistributionChannel()
 * phpcs:disable
 * @method OrderLineItemDistributionChannelSetMessage setDistributionChannel(ChannelReference $distributionChannel = null)
 * phpcs:enable
 */
class OrderLineItemDistributionChannelSetMessage extends Message
{
    const MESSAGE_TYPE = 'OrderLineItemDistributionChannelSet';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['lineItemId'] = [static::TYPE => 'string'];
        $definitions['distributionChannel'] = [static::TYPE => ChannelReference::class];

        return $definitions;
    }
}
