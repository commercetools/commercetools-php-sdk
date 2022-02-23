<?php

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Order\ReturnInfoCollection;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#orderreturninfoset-message
 * @method string getId()
 * @method OrderReturnInfoSetMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method OrderReturnInfoSetMessage setCreatedAt(DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method OrderReturnInfoSetMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method OrderReturnInfoSetMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method OrderReturnInfoSetMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method OrderReturnInfoSetMessage setType(string $type = null)
 * @method string getOrderState()
 * @method OrderReturnInfoSetMessage setOrderState(string $orderState = null)
 * @method int getVersion()
 * @method OrderReturnInfoSetMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method OrderReturnInfoSetMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method OrderReturnInfoSetMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 * @method ReturnInfoCollection getReturnInfo()
 * @method OrderReturnInfoSetMessage setReturnInfo(ReturnInfoCollection $returnInfo = null)
 */
class OrderReturnInfoSetMessage extends Message
{
    const MESSAGE_TYPE = 'ReturnInfoSet';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['returnInfo'] = [static::TYPE => ReturnInfoCollection::class, static::OPTIONAL => true];

        return $definitions;
    }
}
