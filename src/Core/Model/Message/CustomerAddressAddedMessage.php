<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#customeraddressadded-message
 * @method string getId()
 * @method CustomerAddressAddedMessage setId(string $id = null)
 * @method int getVersion()
 * @method CustomerAddressAddedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method CustomerAddressAddedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method CustomerAddressAddedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method CustomerAddressAddedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method CustomerAddressAddedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method CustomerAddressAddedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method CustomerAddressAddedMessage setType(string $type = null)
 * @method Address getAddress()
 * @method CustomerAddressAddedMessage setAddress(Address $address = null)
 */
class CustomerAddressAddedMessage extends Message
{
    const MESSAGE_TYPE = 'CustomerAddressAdded';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['address'] = [static::TYPE => Address::class];

        return $definitions;
    }
}
